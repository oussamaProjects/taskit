<script type="text/javascript">
    const buttonFile = document.getElementById('buttonmodalFile')
    const buttonFileImg = document.getElementById('buttonmodalFileImg')
    const buttonFileA = document.getElementById('buttonmodalFileA')
    const buttonFileB = document.getElementById('buttonmodalFileB')

    const closebuttonFile = document.getElementById('closebuttonFile')
    const modalFile = document.getElementById('modalFile')

    if (buttonFile)
        buttonFile.addEventListener('click', () => modalFile.classList.add('scale-100'))
    if (buttonFileImg)
        buttonFileImg.addEventListener('click', () => modalFile.classList.add('scale-100'))
    if (buttonFileA)
        buttonFileA.addEventListener('click', () => modalFile.classList.add('scale-100'))
    if (buttonFileB)
        buttonFileB.addEventListener('click', () => modalFile.classList.add('scale-100'))
    if (closebuttonFile)
        closebuttonFile.addEventListener('click', () => modalFile.classList.remove('scale-100'))

    const buttonFolder = document.getElementById('buttonmodalFolder')
    const buttonFolderA = document.getElementById('buttonmodalFolderA')
    const buttonFolderImg = document.getElementById('buttonmodalFolderImg')

    const closebuttonFolder = document.getElementById('closebuttonFolder')

    if (buttonFolder)
        buttonFolder.addEventListener('click', () => modalFolder.classList.add('scale-100'))
    if (buttonFolderA)
        buttonFolderA.addEventListener('click', () => modalFolder.classList.add('scale-100'))
    if (buttonFolderImg)
        buttonFolderImg.addEventListener('click', () => modalFolder.classList.add('scale-100'))
    if (closebuttonFolder)
        closebuttonFolder.addEventListener('click', () => modalFolder.classList.remove('scale-100'))

    const closebuttonCategorie = document.getElementById('closebuttonCategorie')
    const modalCategorie = document.getElementById('modalCategorie')
    if (closebuttonCategorie)
        closebuttonCategorie.addEventListener('click', () => modalCategorie.classList.remove('scale-100'))

    const closebutton2 = document.getElementById('closebutton2')
    const modal2 = document.getElementById('modal2')
    if (closebutton2)
        closebutton2.addEventListener('click', () => modal2.classList.remove('scale-100'))

    const add_folder_main = document.getElementById('add_folder_main')
    if (add_folder_main)
        add_folder_main.addEventListener('click', () => modalFolder.classList.add('scale-100'))

    const add_folder = document.getElementById('add_folder')
    if (add_folder)
        add_folder.addEventListener('click', () => modal2.classList.add('scale-100'))

    const add_categorie = document.getElementById('add_categorie')
    if (add_categorie)
        add_categorie.addEventListener('click', () => modalCategorie.classList.add('scale-100'))

    function handleSelect(elm) {

        if (elm.value == 'add_folder_main') {
            modalFolder.classList.add('scale-100')
        }

        if (elm.value == 'add_folder') {
            modal2.classList.add('scale-100')
        }

        if (elm.value == 'add_categorie') {
            modalCategorie.classList.add('scale-100')
        }

    }

    function checkRadio(value) {
        if (value == 2)
            document.getElementById("dossier_parent").classList.add("hidden");
        else
            document.getElementById("dossier_parent").classList.remove("hidden");
        if (value == 1)
            document.getElementById("dossier_parent").classList.remove("hidden");
        else
            document.getElementById("dossier_parent").classList.add("hidden");
    }


    // input: r,g,b in [0,1], out: h in [0,360) and s,v in [0,1]
    function rgb2hsv(r, g, b) {
        let v = Math.max(r, g, b),
            c = v - Math.min(r, g, b);
        let h = c && ((v == r) ? (g - b) / c : ((v == g) ? 2 + (b - r) / c : 4 + (r - g) / c));
        return v && c / v;
        return [60 * (h < 0 ? h + 6 : h), v && c / v, v];
    }

    $(function() {

        setTimeout(() => {}, 400);
        let textColor = '#3a1e2e';
        let folderContainer = $('.doc-folder-container');
        if (folderContainer != null)

            folderContainer.each(function() {
                let folder = $(this);
                let rgb = folder.css("background-color");

                let sep = rgb.indexOf(",") > -1 ? "," : " ";
                // Turn "rgb(r,g,b)" into [r,g,b]
                rgb = rgb.substr(4).split(")")[0].split(sep);

                let r = rgb[0],
                    g = rgb[1],
                    b = rgb[2];

                let l = rgb2hsv(r, g, b);

                if (l < 0.6)
                    textColor = '#fdf4d0';
                if (l == 0)
                    textColor = '#3a1e2e';
                if (l < 0.2)
                    textColor = '#3a1e2e';

                folder.css('color', textColor);

            });


        $(document).on("click", ".update_color", function(e) {
            e.preventDefault();
            var color = $(this).data('color');
            var id = $(this).parents('.colors').data('id');

            var url = "{{ URL('documents/color') }}";
            var url = url + "/" + id;


            $.ajax({
                url: url,
                type: "PATCH",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    color: color,
                },
                success: function(dataResult) {
                    dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode) {
                        location.reload(true);
                    } else {
                        alert("Internal Server Error");
                    }

                },
                error: function(error) {
                    location.reload(true);
                }
            });
        });

        $(document).on("click", ".update_color_folder", function(e) {
            e.preventDefault();
            var color = $(this).data('color');
            var id = $(this).parents('.colors').data('id');

            var url = "{{ URL('folder/color') }}";
            var url = url + "/" + id;


            $.ajax({
                url: url,
                type: "PATCH",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    color: color,
                },
                success: function(dataResult) {
                    dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode) {
                        location.reload(true);
                    } else {
                        alert("Internal Server Error");
                    }

                },
                error: function(error) {
                    location.reload(true);
                }
            });
        });
    });

    function closeAlert(event) {
        let element = event.target;
        while (element.nodeName !== "BUTTON") {
            element = element.parentNode;
        }
        element.parentNode.parentNode.removeChild(element.parentNode);
    }
    setTimeout(() => {
        let notification = document.getElementById('notification');
        if (notification)
            notification.hide();
    }, 400);
    // $(document).ready(function() {   });
</script>
