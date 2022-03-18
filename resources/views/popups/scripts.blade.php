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

    const closeSubFolder = document.getElementById('closeSubFolder')
    const modalSubFolder = document.getElementById('modalSubFolder')
    if (closeSubFolder)
        closeSubFolder.addEventListener('click', () => modalSubFolder.classList.remove('scale-100'))

    const add_folder_main = document.getElementById('add_folder_main')
    if (add_folder_main)
        add_folder_main.addEventListener('click', () => modalFolder.classList.add('scale-100'))

    const add_folder = document.getElementById('add_folder')
    if (add_folder)
        add_folder.addEventListener('click', () => modalSubFolder.classList.add('scale-100'))

    const link_add_categorie = document.getElementById('link_add_categorie')
    if (link_add_categorie)
        link_add_categorie.addEventListener('click', () => modalCategorie.classList.add('scale-100'))

    const add_categorie = document.getElementById('add_categorie')
    if (add_categorie)
        add_categorie.addEventListener('click', () => modalCategorie.classList.add('scale-100'))



    // addDept
    const modalDept = document.getElementById('modalDept')

    const addDeptButton = document.getElementById('addDeptButton')
    if (addDeptButton)
        addDeptButton.addEventListener('click', () => modalDept.classList.add('scale-100'))

    const addDeptButtonFileImg = document.getElementById('addDeptButtonFileImg')
    if (addDeptButtonFileImg)
        addDeptButtonFileImg.addEventListener('click', () => modalDept.classList.add('scale-100'))

    const closebuttonDept = document.getElementById('closebuttonDept')
    if (closebuttonDept)
        closebuttonDept.addEventListener('click', () => modalDept.classList.remove('scale-100'))

    // addUser
    const modalUser = document.getElementById('modalUser')

    const addUserButton = document.getElementById('addUserButton')
    if (addUserButton)
        addUserButton.addEventListener('click', () => modalUser.classList.add('scale-100'))

    const addUserButtonFileImg = document.getElementById('addUserButtonFileImg')
    if (addUserButtonFileImg)
        addUserButtonFileImg.addEventListener('click', () => modalUser.classList.add('scale-100'))

    const closebuttonUser = document.getElementById('closebuttonUser')
    if (closebuttonUser)
        closebuttonUser.addEventListener('click', () => modalUser.classList.remove('scale-100'))

    //addProject
    const modelproject = document.getElementById('modelproject')

    const addUprojectButton = document.getElementById('addUprojectButton')
    if (addUprojectButton)
        addUprojectButton.addEventListener('click', () => modelproject.classList.add('scale-100'))

    const addprojectButtonLink = document.getElementById('addprojectButtonLink')
    if (addprojectButtonLink)
        addprojectButtonLink.addEventListener('click', () => modelproject.classList.add('scale-100'))

    const addprojectButtonFileImg = document.getElementById('addprojectButtonFileImg')
    if (addprojectButtonFileImg)
        addprojectButtonFileImg.addEventListener('click', () => modelproject.classList.add('scale-100'))

    const closebuttonproject = document.getElementById('closebuttonproject')
    if (closebuttonproject)
        closebuttonproject.addEventListener('click', () => modelproject.classList.remove('scale-100'))

    //addclient
    const modelclient = document.getElementById('modelclient')

    const addClientButton = document.getElementById('addClientButton')
    if (addClientButton)
        addClientButton.addEventListener('click', () => modelclient.classList.add('scale-100'))

    const addClientButtonLink = document.getElementById('addClientButtonLink')
    if (addClientButtonLink)
        addClientButtonLink.addEventListener('click', function(e) {
            e.preventDefault();
            modelclient.classList.add('scale-100');
        });

    const addClientButtonFileImg = document.getElementById('addClientButtonFileImg')
    if (addClientButtonFileImg)
        addClientButtonFileImg.addEventListener('click', () => modelclient.classList.add('scale-100'))

    const closebuttonclient = document.getElementById('closebuttonclient')
    if (closebuttonclient)
        closebuttonclient.addEventListener('click', () => modelclient.classList.remove('scale-100'))

    //addparametre
    const modelparametre = document.getElementById('modelparametre')

    const addUparametreButton = document.getElementById('addUparametreButton')
    if (addUparametreButton)
        addUparametreButton.addEventListener('click', () => modelparametre.classList.add('scale-100'))

    const addUparametreButtonLink = document.getElementById('addUparametreButtonLink')
    if (addUparametreButtonLink)
        addUparametreButtonLink.addEventListener('click', () => modelparametre.classList.add('scale-100'))

    const addparametreButtonFileImg = document.getElementById('addparametreButtonFileImg')
    if (addparametreButtonFileImg)
        addparametreButtonFileImg.addEventListener('click', () => modelparametre.classList.add('scale-100'))

    const closebuttonparametre = document.getElementById('closebuttonparametre')
    if (closebuttonparametre)
        closebuttonparametre.addEventListener('click', () => modelparametre.classList.remove('scale-100'))

    //addGoup
    const modelgroup = document.getElementById('modelgroup')

    const addGroupButton = document.getElementById('addGroupButton')
    if (addGroupButton)
        addGroupButton.addEventListener('click', () => modelgroup.classList.add('scale-100'))

    const addGroupButtonLink = document.getElementById('addGroupButtonLink')
    if (addGroupButtonLink)
        addGroupButtonLink.addEventListener('click', () => modelgroup.classList.add('scale-100'))

    const addGroupButtonFileImg = document.getElementById('addGroupButtonFileImg')
    if (addGroupButtonFileImg)
        addGroupButtonFileImg.addEventListener('click', () => modelgroup.classList.add('scale-100'))

    const closebuttonGroup = document.getElementById('closebuttonGroup')
    if (closebuttonGroup)
        closebuttonGroup.addEventListener('click', () => modelgroup.classList.remove('scale-100'))

    //addTask
    const modeltask = document.getElementById('modeltask')

    const addTaskButton = document.getElementById('addTaskButton')
    if (addTaskButton)
        addTaskButton.addEventListener('click', () => modeltask.classList.add('scale-100'))

    const addTaskButtonLink = document.getElementById('addTaskButtonLink')
    if (addTaskButtonLink)
        addTaskButtonLink.addEventListener('click', () => modeltask.classList.add('scale-100'))

    const addTaskButtonFileImg = document.getElementById('addTaskButtonFileImg')
    if (addTaskButtonFileImg)
        addTaskButtonFileImg.addEventListener('click', () => modeltask.classList.add('scale-100'))

    const closebuttontask = document.getElementById('closebuttontask')
    if (closebuttontask)
        closebuttontask.addEventListener('click', () => modeltask.classList.remove('scale-100'))

    // changePassword
    const modalchangePassword = document.getElementById('modalchangePassword')

    const changePasswordButton = document.getElementById('changePasswordButton')
    if (changePasswordButton)
        changePasswordButton.addEventListener('click', () => modalchangePassword.classList.add('scale-100'))

    const closebuttonchangePassword = document.getElementById('closebuttonchangePassword')
    if (closebuttonchangePassword)
        closebuttonchangePassword.addEventListener('click', () => modalchangePassword.classList.remove('scale-100'))

    // addSubs
    const modaladdSubs = document.getElementById('modaladdSubs')

    const addSubsButton = document.getElementById('addSubsButton')
    if (addSubsButton)
        addSubsButton.addEventListener('click', () => modaladdSubs.classList.add('scale-100'))

    const addSubsButtonImg = document.getElementById('addSubsButtonImg')
    if (addSubsButtonImg)
        addSubsButtonImg.addEventListener('click', () => modaladdSubs.classList.add('scale-100'))

    const closebuttonaddSubs = document.getElementById('closebuttonaddSubs')
    if (closebuttonaddSubs)
        closebuttonaddSubs.addEventListener('click', () => modaladdSubs.classList.remove('scale-100'))


    function handleSelect(elm) {

        if (elm.value == 'add_folder_main') {
            modalFolder.classList.add('scale-100')
        }

        if (elm.value == 'add_folder') {
            modalSubFolder.classList.add('scale-100')
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
