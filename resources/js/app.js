/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function(){
    $(".alert").on("click", function(){
        $(".alert").fadeOut();
    });
    $("table.simonboard tbody tr").on("click", function(){
        var id = $(this).data("id");
        var page = $("input[name=page]").val();
        location.href="/board/show/" + id + "?page=" + page;
    });
    $(".commentarea .btn.comment").on("click", function(){
        var data = $("form[name=cform]").serialize();
        var cmt = $("textarea.comment").val();
        if(cmt == ""){
            alert("댓글 내용을 입력해주세요.");
            return;
        }
        $.post("/api/cmtwrite", data, function(d){
            console.log(d);
            if(d.rescode == "0000"){
                location.reload();
            }else{
                alert(d.resmsg);
            }
        });
    });
    $(".action .glyphicon-trash").on("click", function(){
        var id = $(this).data("id");
        if(confirm("댓글을 삭제하시겠습니까?")){
            $("form[name=cmtform] input[name=id]").val(id);
            var data = $("form[name=cmtform]").serialize();
            $.post("/api/cmtremove", data, function(d){
                console.log(d);
                if(d.rescode == "0000"){
                    location.reload();
                }else{
                    alert(d.resmsg);
                }
            });
        };
    });
});