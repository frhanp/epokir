<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Data (Referensi)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4">Master Kategori</h3>
                    <form action="{{ route('master.kategori.store') }}" method="POST" class="mb-4 flex gap-2">
                        @csrf
                        <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="w-full text-sm border-gray-300 rounded" required>
                        <button class="bg-blue-600 text-white px-3 rounded text-sm">+</button>
                    </form>
                    <ul class="space-y-2">
                        @foreach($kategoris as $item)
                        <li class="flex justify-between items-center text-sm border-b pb-1">
                            {{ $item->nama_kategori }}
                            <form action="{{ route('master.kategori.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Hapus?')">x</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4">Master OPD</h3>
                    <form action="{{ route('master.opd.store') }}" method="POST" class="mb-4 flex gap-2">
                        @csrf
                        <input type="text" name="nama_dinas" placeholder="Nama Dinas" class="w-full text-sm border-gray-300 rounded" required>
                        <button class="bg-blue-600 text-white px-3 rounded text-sm">+</button>
                    </form>
                    <ul class="space-y-2">
                        @foreach($opds as $item)
                        <li class="flex justify-between items-center text-sm border-b pb-1">
                            {{ $item->nama_dinas }}
                            <form action="{{ route('master.opd.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Hapus?')">x</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4">Master Aleg</h3>
                    <form action="{{ route('master.aleg.store') }}" method="POST" class="mb-4 flex gap-2">
                        @csrf
                        <input type="text" name="nama" placeholder="Nama Aleg" class="w-full text-sm border-gray-300 rounded" required>
                        <button class="bg-blue-600 text-white px-3 rounded text-sm">+</button>
                    </form>
                    <ul class="space-y-2">
                        @foreach($alegs as $item)
                        <li class="flex justify-between items-center text-sm border-b pb-1">
                            {{ $item->nama }}
                            <form action="{{ route('master.aleg.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Hapus?')">x</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>