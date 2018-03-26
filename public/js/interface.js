"use strict";

function initiateNav() {

    document.querySelector('#prev').addEventListener("click", function () {
        var galery_section = document.querySelector('#galery_section');
        var elems = galery_section.getElementsByTagName('*')
        for (var i = 0; i < elems.length; i++) {
            console.log(elems[i].getAttribute("name"));
        };
    });
    document.querySelector('#next').addEventListener("click", function () {
        var galery_section = document.querySelector('#galery_section');
        var elems = galery_section.getElementsByTagName('a')
        for (var i = 0; i < elems.length; i++) {
            console.log(elems[i]);
            console.log(elems[i].getAttribute("name"));

        };
    });

}

initiateNav();
