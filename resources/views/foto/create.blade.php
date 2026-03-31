<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Foto - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center py-12 px-4">

    <div class="max-w-4xl w-full">
        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 mb-6 font-semibold transition">
            <i class="fas fa-arrow-left text-sm"></i> Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100 flex flex-col md:flex-row">
            
            <div class="w-full md:w-1/2 bg-slate-100 p-8 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-slate-100">
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-4">Preview Foto</p>
                <div id="preview-container" class="w-full h-80 rounded-2xl border-4 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden relative bg-white shadow-inner">
                    <i id="placeholder-icon" class="fas fa-cloud-upload-alt text-5xl text-slate-300 mb-2"></i>
                    <p id="placeholder-text" class="text-slate-400 text-sm font-medium">Belum ada foto dipilih</p>
                    <img id="image-preview" class="hidden w-full h-full object-cover">
                </div>
                <p class="mt-4 text-[11px] text-slate-400 text-center italic">Pastikan format file berupa JPG, PNG, atau JPEG (Max 2MB)</p>
            </div>

            <div class="w-full md:w-1/2 p-10">
                <div class="mb-8">
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em] mb-2 block">New Upload</span>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Unggah <span class="text-blue-600">Momen</span></h2>
                    <p class="text-slate-500 text-sm">Bagikan karya terbaik Anda ke dalam album.</p>
                </div>

                <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Pilih File</label>
                        <input type="file" name="lokasiFile" id="lokasiFile" onchange="previewImage()" 
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition cursor-pointer" 
                               required>
                        @error('lokasiFile') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Judul Foto</label>
                        <input type="text" name="judulFoto" placeholder="Contoh: Senja di Pantai" value="{{ old('judulFoto') }}"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-bold text-slate-700" 
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Pilih Album <span class="text-red-500">*</span></label>
                        <select name="albumID" 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition cursor-pointer font-bold text-slate-700" 
                                required>
                            <option value="" disabled selected>-- Pilih Album Tujuan --</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->albumID }}" {{ old('albumID') == $album->albumID ? 'selected' : '' }}>
                                    {{ $album->namaAlbum }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-blue-500 mt-2 italic font-medium">
                            <i class="fas fa-info-circle mr-1"></i> Foto wajib dimasukkan ke dalam album koleksi Anda.
                        </p>
                        @error('albumID') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Deskripsi</label>
                        <textarea name="deskripsiFoto" rows="3" placeholder="Ceritakan sedikit tentang foto ini..." 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none font-medium text-slate-600" 
                                  required>{{ old('deskripsiFoto') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white font-black text-xs uppercase tracking-widest py-4 rounded-2xl hover:bg-blue-600 hover:shadow-xl hover:shadow-blue-200 transition duration-300 transform active:scale-[0.98] flex items-center justify-center gap-3">
                        <i class="fas fa-cloud-upload-alt"></i> Publikasikan Foto
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const input = document.getElementById('lokasiFile');
            const preview = document.getElementById('image-preview');
            const placeholderIcon = document.getElementById('placeholder-icon');
            const placeholderText = document.getElementById('placeholder-text');
            const container = document.getElementById('preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholderIcon.classList.add('hidden');
                    placeholderText.classList.add('hidden');
                    container.classList.remove('border-dashed');
                    container.classList.add('border-solid', 'border-white');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>