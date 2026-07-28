#!/bin/bash

# Konfigurasi direktori
BACKUP_DIR="/var/www/epokir/storage/app/backups"
ENV_FILE="/var/www/epokir/.env"

# Buat folder backup jika belum ada
mkdir -p "$BACKUP_DIR"

# Baca kredensial database langsung dari file .env
if [ -f "$ENV_FILE" ]; then
    DB_DATABASE=$(grep -v '^#' "$ENV_FILE" | grep '^DB_DATABASE=' | cut -d '=' -f2 | tr -d '\r' | tr -d '"' | tr -d "'")
    DB_USERNAME=$(grep -v '^#' "$ENV_FILE" | grep '^DB_USERNAME=' | cut -d '=' -f2 | tr -d '\r' | tr -d '"' | tr -d "'")
    DB_PASSWORD=$(grep -v '^#' "$ENV_FILE" | grep '^DB_PASSWORD=' | cut -d '=' -f2 | tr -d '\r' | tr -d '"' | tr -d "'")
    DB_HOST=$(grep -v '^#' "$ENV_FILE" | grep '^DB_HOST=' | cut -d '=' -f2 | tr -d '\r' | tr -d '"' | tr -d "'")
else
    echo "Error: File .env tidak ditemukan di $ENV_FILE"
    exit 1
fi

# Penamaan file backup dengan timestamp tanggal dan jam
DATE=$(date +"%Y-%m-%d_%H%M%S")
BACKUP_FILE="$BACKUP_DIR/db-backup-$DATE.sql"

echo "--> Memulai proses backup database: $DB_DATABASE..."

# Eksekusi mysqldump
if [ -n "$DB_PASSWORD" ]; then
    mysqldump -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" > "$BACKUP_FILE"
else
    mysqldump -h "$DB_HOST" -u "$DB_USERNAME" "$DB_DATABASE" > "$BACKUP_FILE"
fi

# Validasi keberhasilan mysqldump
if [ $? -eq 0 ]; then
    # Kompresi file SQL menjadi format .gz agar menghemat ruang SD Card
    gzip -f "$BACKUP_FILE"
    echo "Backup berhasil disimpan: $BACKUP_FILE.gz"
else
    echo "Error: Proses mysqldump gagal."
    rm -f "$BACKUP_FILE"
    exit 1
fi

# Rotasi backup: Hapus file backup yang berumur lebih dari 7 hari agar penyimpanan Armbian tidak penuh
echo "--> Menghapus file backup lama (berumur > 7 hari)..."
find "$BACKUP_DIR" -name "db-backup-*.sql.gz" -type f -mtime +7 -delete

echo "Proses rotasi backup selesai!"
