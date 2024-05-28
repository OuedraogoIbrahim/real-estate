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
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="container">
        <form class="form" action="{{ route('admin.update', ['admin' => $appartement->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <p class="title">Edition d'un article</p>
            <p class="message">Tous les champs sont obligatoires </p>
            <div class="flex">
                <label>
                    <input class="input" type="text" name="ville" id="ville" required
                        value="{{ $appartement->ville }}">
                    <span>La ville</span>
                    @error('ville')
                        <h5>{{ $message }}</h5>
                    @enderror
                </label>

                <label>

                    <input class="input" type="text" name="titre" id="titre" required
                        value="{{ $appartement->titre }}">
                    <span>Le titre</span>
                    @error('titre')
                        <h5> {{ $message }}</h5>
                    @enderror
                </label>
            </div>

            <label>
                <input class="input" type="text" name="description" id="description" required
                    value="{{ $appartement->description }}">
                <span>La description</span>

                @error('description')
                    <h5> {{ $message }}</h5>
                @enderror
            </label>

            <label>
                <input class="input" type="number" name="surface" id="surface" required
                    value="{{ $appartement->surface }}">
                <span>La surface</span>
                @error('surface')
                    <h5> {{ $message }}</h5>
                @enderror

            </label>
            <label>
                <input class="input" type="number" name="chambres" id="chambres" required
                    value="{{ $appartement->chambres }}">
                <span>Les chambres</span>
                @error('chambres')
                    <h5> {{ $message }}</h5>
                @enderror

            </label>

            <label>
                <input class="input" type="number" name="prix" id="prix" required
                    value="{{ $appartement->prix }}">
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
                        <option value="{{ $category->id }}"
                            {{ $category->id == $category_appart->id ? 'selected' : null }}>
                            {{ $category->nom }}
                        </option>
                    @endforeach

                    @error('select')
                        <h5> {{ $message }}</h5>
                    @enderror
                </select>

            </label>

            <div class="containt">
                <input type="file" id="file" accept="image/*" hidden name="image" required>
                <div class="img-area" data-img="">
                    <i class='bx bxs-cloud-upload icon'></i>
                    <h3>Uploader votre image</h3>
                    <p>Inserer une image de type : <span>pnj , jpeg , jpg</span></p>
                    <img src="{{ asset("storage/$appartement->image") }}">
                </div>
                @error('image')
                    {{ $message }}
                @enderror
                <div class="select-image">Appuyez ici pour choisir une image</div>
            </div>
            <button class="submit">Editer</button>
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
