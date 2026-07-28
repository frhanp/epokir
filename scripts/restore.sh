#!/bin/bash

# Konfigurasi
ENV_FILE="/var/www/epokir/.env"
BACKUP_DIR="/var/www/epokir/storage/app/backups"

# Validasi argumen nama file
if [ -z "$1" ]; then
    echo "Penggunaan: $0 <nama_file_backup.sql.gz>"
    echo "Contoh: $0 db-backup-2026-07-28_100234.sql.gz"
    echo ""
    echo "Daftar berkas backup yang tersedia di folder:"
    if [ -d "$BACKUP_DIR" ]; then
        ls -1 "$BACKUP_DIR"
    else
        echo "(Belum ada backup)"
    fi
    exit 1
fi

BACKUP_FILE="$BACKUP_DIR/$1"

# Cek apakah file ada
if [ ! -f "$BACKUP_FILE" ]; then
    # Jika user menulis full path
    BACKUP_FILE="$1"
    if [ ! -f "$BACKUP_FILE" ]; then
        echo "Error: Berkas backup tidak ditemukan: $BACKUP_FILE"
        exit 1
    fi
fi

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

echo "⚠️  PERINGATAN: Menjalankan restore akan menimpa seluruh data saat ini pada database '$DB_DATABASE'!"
read -p "Apakah Anda yakin ingin melanjutkan proses restore ini? (y/N): " confirm
if [[ ! "$confirm" =~ ^[Yy]$ ]]; then
    echo "Proses restore dibatalkan."
    exit 0
fi

echo "--> Memulai proses restore database dari $BACKUP_FILE..."

# Pipe output ekstraksi gunzip langsung ke mysql tanpa menulis file mentah ke disk (Menghemat umur SD Card)
if [ -n "$DB_PASSWORD" ]; then
    gunzip -c "$BACKUP_FILE" | mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE"
else
    gunzip -c "$BACKUP_FILE" | mysql -h "$DB_HOST" -u "$DB_USERNAME" "$DB_DATABASE"
fi

if [ $? -eq 0 ]; then
    echo "🎉 Sukses! Database telah berhasil dipulihkan (restore) ke keadaan semula."
else
    echo "❌ Error: Proses restore database gagal."
    exit 1
fi
