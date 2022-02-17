<script type="text/javascript">
    const buttonFile = document.getElementById('buttonmodalFile')
    const buttonFileA = document.getElementById('buttonmodalFileA')
    const buttonFileB = document.getElementById('buttonmodalFileB')

    const closebuttonFile = document.getElementById('closebuttonFile')
    const modalFile = document.getElementById('modalFile')

    if (buttonFile)
        buttonFile.addEventListener('click', () => modalFile.classList.add('scale-100'))
    if (buttonFileA)
        buttonFileA.addEventListener('click', () => modalFile.classList.add('scale-100'))
    if (buttonFileB)
        buttonFileB.addEventListener('click', () => modalFile.classList.add('scale-100'))

    closebuttonFile.addEventListener('click', () => modalFile.classList.remove('scale-100'))

    const buttonDossier = document.getElementById('buttonmodalDossier')
    const buttonDossierA = document.getElementById('buttonmodalDossierA')

    const closebuttonDossier = document.getElementById('closebuttonDossier')
    const modalDossier = document.getElementById('modalDossier')
    if (buttonDossier)
        buttonDossier.addEventListener('click', () => modalDossier.classList.add('scale-100'))
    if (buttonDossierA)
        buttonDossierA.addEventListener('click', () => modalDossier.classList.add('scale-100'))
    closebuttonDossier.addEventListener('click', () => modalDossier.classList.remove('scale-100'))

    const closebuttonCategorie = document.getElementById('closebuttonCategorie')
    const modalCategorie = document.getElementById('modalCategorie')

    closebuttonCategorie.addEventListener('click', () => modalCategorie.classList.remove('scale-100'))

    const closebutton2 = document.getElementById('closebutton2')
    const modal2 = document.getElementById('modal2')

    closebutton2.addEventListener('click', () => modal2.classList.remove('scale-100'))

    const add_folder_main = document.getElementById('add_folder_main')
    add_folder_main.addEventListener('click', () => modalDossier.classList.add('scale-100'))

    const add_folder = document.getElementById('add_folder')
    add_folder.addEventListener('click', () => modal2.classList.add('scale-100'))

    const add_categorie = document.getElementById('add_categorie')
    add_categorie.addEventListener('click', () => modalCategorie.classList.add('scale-100'))

    function handleSelect(elm) {

        if (elm.value == 'add_folder_main') {
            modalDossier.classList.add('scale-100')
        }

        if (elm.value == 'add_folder') {
            modal2.classList.add('scale-100')
        }

        if (elm.value == 'add_categorie') {
            modalCategorie.classList.add('scale-100')
        }

    }

    function checkRadio(value) {
        console.log(value);
        if (value == 2) {
            document.getElementById("dossier_parent").classList.add("hidden");
        }
        if (value == 1) {
            document.getElementById("dossier_parent").classList.remove("hidden");
        }
    }

    
            // input: r,g,b in [0,1], out: h in [0,360) and s,v in [0,1]
            function rgb2hsv(r, g, b) {
                let v = Math.max(r, g, b),
                    c = v - Math.min(r, g, b);
                let h = c && ((v == r) ? (g - b) / c : ((v == g) ? 2 + (b - r) / c : 4 + (r - g) / c));
                return v && c / v;
                return [60 * (h < 0 ? h + 6 : h), v && c / v, v];
            }
            $(document).ready(function(e) {

                setTimeout(() => {}, 400);
                let textColor = '#3a1e2e';
                let folderContainer = $('.folder-container');
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
                            textColor = '#FFFFFF';
                          if (l == 0)
                            textColor = '#3a1e2e';

                        folder.css('color', textColor);
                        console.log('Light : ' + l);

                    });
            });


</script>
