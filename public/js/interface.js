'use strict';

let SERVER_ADDR = 'http://php1.courses.local/getpage.php';
let _200_OK = 200;

function navSectionClickHandler(event){
    let obj = event.target;
    if(obj.id == "prev" || obj.id == "next"){
        let navpage = obj.getAttribute('page_no');
        if(navpage>0){
            let xhr = new XMLHttpRequest();
            xhr.open('GET', SERVER_ADDR+'?page_no=' + navpage, true);
            xhr.timeout = 15000;
            xhr.ontimeout = function(){
                console.log('Время ожидания истекло');
            }
            xhr.send();
            xhr.onreadystatechange = function(){
                if(xhr.readyState === xhr.DONE){
                    if(xhr.status === _200_OK){
                        let newSectionCode = xhr.responseText;
                        let galery_section = document.querySelector('#galery_section');
                        console.log(newSectionCode);
                        galery_section.innerHTML = newSectionCode.toString();
                    }else{
                        console.log(xhr.status+': '+xhr.statusText['errno']);
                    }
                }
            }
            
        }
    }
    
    
}


function initiateNav() {

    let nav = document.querySelector('#prev');
    nav.addEventListener("click", navSectionClickHandler, false);
    nav = document.querySelector('#next');
    nav.addEventListener("click", navSectionClickHandler, false);
    
}

initiateNav();
