<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/editform.css') }}">

</head>

<body>

    <div class="container">
        <form class="form" action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p class="title">Creation d'un article</p>
            <p class="message">Tous les champs sont obligatoires </p>
            <div class="flex">
                <label>
                    <input class="input" type="text" name="ville" id="ville" required
                        value="{{ old('ville') }}">
                    <span>La ville</span>
                    @error('ville')
                        <h5>{{ $message }}</h5>
                    @enderror
                </label>

                <label>

                    <input class="input" type="text" name="titre" id="titre" required
                        value="{{ old('titre') }}">
                    <span>Le titre</span>
                    @error('titre')
                        <h5> {{ $message }}</h5>
                    @enderror
                </label>
            </div>

            <label>
                <input class="input" type="text" name="description" id="description" required
                    value="{{ old('description') }}">
                <span>La description</span>

                @error('description')
                    <h5> {{ $message }}</h5>
                @enderror
            </label>

            <label>
                <input class="input" type="number" name="surface" id="surface" required
                    value="{{ old('surface') }}">
                <span>La surface</span>
                @error('surface')
                    <h5> {{ $message }}</h5>
                @enderror

            </label>
            <label>
                <input class="input" type="number" name="chambres" id="chambres" required
                    value="{{ old('chambres') }}">
                <span>Les chambres</span>
                @error('chambres')
                    <h5> {{ $message }}</h5>
                @enderror

            </label>

            <label>
                <input class="input" type="number" name="prix" id="prix" required
                    value="{{ old('prix') }}">
                <span>Le prix</span>

                @error('prix')
                    <h5> {{ $message }}</h5>
                @enderror

            </label>

            <label>
                <select name="select" required>
                    <option value="">
                        <h3>selectionner la categorie</h3>
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->nom }}
                        </option>
                    @endforeach

                    @error('select')
                        {{ $message }}
                    @enderror
                </select>

            </label>

            <div class="containt">
                <input type="file" id="file" accept="image/*" hidden name="image" required>
                <div class="img-area" data-img="">
                    <i class='bx bxs-cloud-upload icon'></i>
                    <h3>Uploader votre image</h3>
                    <p>Inserer une image de type : <span>pnj , jpeg , jpg</span></p>
                </div>
                @error('image')
                    {{ $message }}
                @enderror
                <div class="select-image">Appuyez ici pour choisir une image</div>
            </div>

            <button class="submit">Créer</button>
            <p class="signin">Revenir en arrierre <a href="{{ route('admin.index') }}">Cliquez ici</a> </p>



        </form>
    </div>
    <script>
        new TomSelect('select');
    </script>

    <script>
        const selectImage = document.querySelector('.select-image');
        const inputFile = document.querySelector('#file');
        const imgArea = document.querySelector('.img-area');

        selectImage.addEventListener('click', function() {
            inputFile.click();
        })

        inputFile.addEventListener('change', function() {
            const image = this.files[0]

            const reader = new FileReader();
            reader.onload = () => {
                const allImg = imgArea.querySelectorAll('img');
                allImg.forEach(item => item.remove());
                const imgUrl = reader.result;
                const img = document.createElement('img');
                img.src = imgUrl;
                imgArea.appendChild(img);
                imgArea.classList.add('active');
                imgArea.dataset.img = image.name;
            }
            reader.readAsDataURL(image);

        })
    </script>
</body>

</html>
