<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center py-12 px-4">

    <div class="max-w-4xl w-full">
        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 mb-6 font-semibold transition">
            <i class="fas fa-arrow-left text-sm"></i> Batal & Kembali
        </a>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100 flex flex-col md:flex-row">
            
            <div class="w-full md:w-1/2 bg-slate-100 p-8 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-slate-100">
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-4">Preview Foto</p>
                <div id="preview-container" class="w-full h-80 rounded-2xl border-4 border-solid border-white flex flex-col items-center justify-center overflow-hidden relative bg-white shadow-inner">
                    <img id="image-preview" src="{{ asset('storage/foto/' . $foto->lokasiFile) }}" class="w-full h-full object-cover">
                </div>
                <p class="mt-4 text-[11px] text-slate-400 text-center italic">Biarkan kosong jika tidak ingin mengubah file gambar</p>
            </div>

            <div class="w-full md:w-1/2 p-10">
                <div class="mb-8">
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Edit <span class="text-amber-500">Informasi</span></h2>
                    <p class="text-slate-500 text-sm">Perbarui detail momen Anda.</p>
                </div>

                <form action="{{ route('foto.update', $foto->fotoID) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Ganti Foto (Opsional)</label>
                        <input type="file" name="lokasiFile" id="lokasiFile" onchange="previewImage()" 
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100 transition cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Judul Foto</label>
                        <input type="text" name="judulFoto" value="{{ old('judulFoto', $foto->judulFoto) }}"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Simpan ke Album</label>
                        <select name="albumID" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none transition cursor-pointer">
                            <option value="">-- Tanpa Album (Foto Mandiri) --</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->albumID }}" {{ $foto->albumID == $album->albumID ? 'selected' : '' }}>
                                    {{ $album->namaAlbum }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-slate-400 mt-2 italic">*Pilih album jika ingin memasukkan foto ini ke kategori tertentu.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Deskripsi</label>
                        <textarea name="deskripsiFoto" rows="3" 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none transition resize-none" required>{{ old('deskripsiFoto', $foto->deskripsiFoto) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-amber-500 text-white font-bold py-4 rounded-2xl hover:bg-amber-600 hover:shadow-lg hover:shadow-amber-200 transition duration-300 transform active:scale-[0.98]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <form action="{{ route('foto.destroy', $foto->fotoID) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin menghapus foto ini selamanya?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 text-red-500 font-bold py-3 rounded-2xl hover:bg-red-500 hover:text-white transition duration-300">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Foto
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const input = document.getElementById('lokasiFile');
            const preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>