<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <!-- jQuery PJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"
        integrity="sha512-7G7ueVi8m7Ldo2APeWMCoGjs4EjXDhJ20DrPglDQqy8fnxsFQZeJNtuQlTT0xoBQJzWRFp4+ikyMdzDOcW36kQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/translations/ru.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>@yield('title')</title>
</head>

<body>
    <header>
        @include('main.includes.header')
    </header>
    <main class="d-flex flex-nowrap justify-content-center">
        @include('main.includes.categories')
        <div class="container" style="max-width: 720px;">
            @yield('content')
        </div>
        @include('main.includes.login')
        @include('main.includes.modals')
    </main>
</body>
<script>
    async function setRating(voteType, id) {
        let response = await fetch(`/${voteType}/${id}`);
        if (response.ok) {
            $.pjax.reload(`#buttons${id}`);
        } else {
            console.log("Ошибка HTTP: " + response.status);
        }
    }
    $(document).ready(function() {
        $('.selectTags').select2({
            theme: 'bootstrap-5',
            placeholder: "Выберите теги",
        });
        var option = {
            language: 'ru',
            ckfinder: {
                uploadUrl: '{{ route('admin.post.ckeditor') . '?_token=' . csrf_token() }}',
            },
            mediaEmbed: {
                previewsInData: true
            }
        }
        ClassicEditor
            .create(document.querySelector('#newEditor'), option)
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
        ClassicEditor
            .create(document.querySelector('#editEditor'), option)
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    });
</script>

</html>
