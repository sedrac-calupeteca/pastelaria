(function(win,doc){
    const formFile = doc.querySelector("#form-file");
    const btnFiles = doc.querySelectorAll(".btn-file");

    btnFiles.forEach(item => {

        item.addEventListener("click",(e)=>{
            if(item.hasAttribute('url')){
                formFile.action = item.getAttribute('url');
            }
        });

    });

})(window,document)
