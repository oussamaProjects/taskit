function log($msg) {
    console.log($msg);
}

var toggler = document.getElementsByClassName("open-folder");
var i;

for (i = 0; i < toggler.length; i++) {
    toggler[i].addEventListener("click", function() {
        this.parentElement.querySelector(".nested").classList.toggle("hide");
        // this.classList.toggle("hidden");
        // this.nextSibling.classList.toggle("hidden");
        console.log(this.querySelector('.opened-folder'));
        this.querySelector('.opened-folder').classList.toggle("hidden");
        this.querySelector('.closed-folder').classList.toggle("hidden");
    });
}

// var closeFolder = document.getElementsByClassName("close-folder");
// closeFolder.addEventListener("click", function() {
//     this.parentElement.querySelector(".nested").classList.remove("hide");
// });