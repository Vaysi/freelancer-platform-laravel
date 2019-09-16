// Basic Initialize
window._ = require('lodash');
import $ from "jquery";
import Echo from 'laravel-echo';
window.$ = window.jQuery = $;
window.jQuery =
window.Popper = require('popper.js').default;
require('bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);
require('overlayscrollbars/js/jquery.overlayScrollbars.min');
require('bootstrap-select');
require('sweetalert2/dist/sweetalert2.all.min');
require('leaflet/dist/leaflet');
if(document.querySelectorAll('.editordata').length){
    require('summernote/dist/summernote-bs4.min');
}
if(document.querySelectorAll('.gallery').length){
    const gallery = require('gallery');
    gallery(document.querySelector('.gallery'))
}
window.onload = function(){
    // Move Scroll If Loaded
    setTimeout(function () {
        let hash =  window.location.hash;
        if(hash.length && $(hash).length){
            moveScroll(hash);
        }
    },200);
};
// Pusher
require('pusher-js');


window.contentS = "",window.sidebarS = "";
// Jquery Stuff
$(function () {
    $('.toast').toast({
        delay:5000
    });
    // Logout
    $("#logout").click(function (e) {
        e.preventDefault();
        $("#logoutForm").submit();
    });
    // Notification Dropdown
    $('#messageDropdown').on('shown.bs.dropdown', function () {
        $('.messages').overlayScrollbars({
            scrollbars : {
                autoHide : "leave"
            },
        });
    });
    // Content Scroll
    window.contentS = $('#content').overlayScrollbars({
        autoUpdate:true,
        scrollbars : {
            autoHide : "leave"
        },
    });
    // Sidebar Scroll
    window.sidebarS = $('#sidebar .wrapper').overlayScrollbars({
        className:"os-theme-light",
        autoUpdate:true,
        scrollbars : {
            autoHide : "leave"
        },
    }).removeClass("os-host-rtl");
    // Action Verification Required
    $(".btn-ask").click(function (e) {
        e.preventDefault();
        swal.fire({
            title: 'آیا از درخواست خود اطمینان دارد ؟',
            text: "فقط در صورتی تایید کنید که از عملیات مورد نظر اطلاع دارید",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله !',
            cancelButtonText: 'خیر'
        }).then((result) => {
            if (result.value) {
                if(e.target.tagName.toLowerCase() == "button"){
                    $(this).parents('form').first().submit();
                }else {
                    window.location.href = $(this).attr('href');
                }
            }
        });
    });
    $('.menu .has-dropdown').click(function () {
        if($(this).hasClass('active')){
            $(this).removeClass('active').next('.submenu').removeClass('active').slideUp(500);
        }else {
            $('.menu .has-dropdown.active').removeClass('active');
            $(this).addClass('active');
            $('.menu .submenu.active').removeClass('active').slideUp(500);
            $(this).next('.submenu').slideDown(500).addClass('active');
            moveScroll('#sidebar .menu .nav-link',700,0,true);
        }
    });
    $('.toggle a').click(function () {
        $('.toggle a.active').removeClass('active');
        $(this).addClass('active');
        let target = $(this).attr('data-target');
        $(target).siblings('.hide').removeClass('active').fadeOut(function () {
            setTimeout(function(){
                $(target).fadeIn().addClass('active');
            },200);
        });
    });
    $('select').selectpicker();
    /*$('body').on("click","a:not(.button):not([role=option])",function(e){
        e.preventDefault();
        let thiss = $(this);
        let page = $(this).attr('href');
        let current = window.location.href.split("#")[0].split("?")[0];
        if(page == current){
            return false;
        }
        if(page.indexOf(url + '/user') < 0){
            window.location.href = page;
        }else {
            loading();
            $("#container").animate({opacity:0},1000);
            $('body #content').load(page + " #content",function (e) {
            if(thiss.parents('.submenu').length){
                $('#sidebar .wrapper nav a.active').removeClass('active starPoint');
                thiss.parents('.submenu').prev('a').addClass('active starPoint');
                thiss.addClass('active');
            }else {
                $('#sidebar .wrapper nav a.active').removeClass('active starPoint');
                thiss.addClass('active starPoint');
            }
            ChangeUrl($(e).find('title').text(),page);
            $("#content .header").unwrap('.content-wrapper');
            $('select').selectpicker('refresh');
                $('#container').animate({opacity: 1},1000,function () {
                    loading(false);
                })
            });
        }
    });*/
    $(document).mouseup(function(e)
    {
        let container = $("#sidebar");
        if(container.hasClass('active')){
            if (!container.is(e.target) && container.has(e.target).length === 0)
            {
                container.removeClass('active');
            }
        }
    });
    $('.toggleMenu').click(function () {
        $('#sidebar').toggleClass('active');
    });
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-toggle="redirect"]').click(function (e) {
        e.preventDefault();
        window.location.href = $(this).data('url');
    });

    $('[data-toggle="scroll"]').click(function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        moveScroll(target);
    });

});
global.loading = function($status=true){
    if($status){
        $("#loading").collapse('show');
    }else {
        setTimeout(function () {
            $("#loading").collapse('hide');
        },1000);
    }
};
function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        let obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
    }
};
global.number_format = function (number, decimals, decPoint, thousandsSep) {
    decimals = Math.abs(decimals) || 0;
    number = parseFloat(number);

    if (!decPoint || !thousandsSep) {
        decPoint = '.';
        thousandsSep = ',';
    }

    let roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
    let numbersString = decimals ? (roundedNumber.slice(0, decimals * -1) || 0) : roundedNumber;
    let decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
    let formattedNumber = "";

    while (numbersString.length > 3) {
        formattedNumber += thousandsSep + numbersString.slice(-3)
        numbersString = numbersString.slice(0, -3);
    }

    if (decimals && decimalsString.length === 1) {
        while (decimalsString.length < decimals) {
            decimalsString = decimalsString + decimalsString;
        }
    }

    return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
};
global.moveScroll = function (to, delay = 700, skip=150,sidebar=false) {
    if(sidebar){
        sidebarS.overlayScrollbars().scroll({ y : $(to).last().offset().top , x:0 }, delay);
    }else {
        contentS.overlayScrollbars().scroll({ y : $(to).offset().top - parseInt(skip) , x:0 }, delay);
    }
};
global.ringnow = function(){
    let audio = new Audio(window.location.origin + "/js/ring.mp3");
    audio.play();
};
// Vue.js Stuff
// Crsf Token
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}
// Csrf Token End
const app = new Vue({
    el: '#vue',
    data: {
        userID: null,
        users: [],
        messages: [],
        chatOpen: false,
        chatUserID: null,
        loadingMessages: false,
        project_id:0,
        newMessage: '',
        sendingMessage:false,
        pusher : new Pusher('fc668119b6e95498a6ae', {
            cluster: 'ap2',
            forceTLS: true
        }),
        lastTime:'',
        lastTitle:'',
        lastMsg:''
},
    mounted () {
        // Assign the ID from meta tag for future use in application
        this.userID = document.head.querySelector('meta[name="userID"]').content;
        this.pusher.bind('connected', function ($data) {
            axios.post(url + '/user/api/user/online', {
                online: 1
            })
        });
        this.pusher.bind('disconnected', function ($data) {
            axios.post(url + '/user/api/user/online', {
                online: 0
            })
        });
        let ch = this.pusher.subscribe('newMessage.' + this.userID);
        let app = this;
        ch.bind('App\\Events\\newChatMessage', function (data) {
            ringnow();
            app.lastTitle = (app.userID == data.message.receiver.id ? data.message.sender.nicky : data.message.receiver.nicky);
            app.lastTime = data.message.ago;
            app.lastMsg = data.message.content.substr(0,20) + '...';
            $('.toast').toast('show');
            $('#onlineChat .count').text(data.message.countUnread);
            $('#onlineChat button').addClass('animated shake infinite');
        });
        ch.bind('App\\Events\\newProject', function (data) {
            app.lastTitle = data.project.title;
            app.lastTime = 'لحظاتی پیش';
            app.lastMsg = `<a href='${data.project.link}' class="text-info">` + data.project.content.substr(0,20) + '...' + "</a>";
            $('.toast').toast('show');
        });
    },
    created () {
        let app = this;
        app.loadUsers()
    },
    watch: {
        messages: function () {
            let element = this.$refs.messageBox;
            element.scrollTop = element.scrollHeight
        }
    },
    methods: {
        openChat (userID,project_id) {
            let app = this;
            if (app.chatUserID !== userID) {
                app.chatOpen = true;
                app.chatUserID = userID;
                app.project_id = project_id;
                // // Start pusher listener
                let channel = app.pusher.subscribe('newMessage.' + app.chatUserID + '.' + app.userID);
                axios.get(url + '/user/api/user/read', {
                    params: {
                        user_id: userID
                    }
                });
                $('#onlineChat .count').text('').hide();
                $('#onlineChat button').removeClass('animated shake infinite');
                channel.bind('App\\Events\\newChatMessage', function (data) {
                    if (app.chatUserID) {
                        app.messages.push(data.message);
                        ringnow();
                        let thisIs = "#frame .content .messages";
                        $(thisIs).animate({ scrollTop: $(thisIs + " ul").height() });
                    }
                });
                // End pusher listener
                app.loadMessages()
            }
        },
        loadUsers () {
            let app = this;
            axios.get(url + '/user/api/users')
                .then((resp) => {
                    app.users = resp.data
            });
        },
        loadMessages () {
            let app = this;
            app.loadingMessages = true;
            app.messages = [];
            axios.post(url + '/user/api/messages', {
                sender_id: app.chatUserID
            }).then((resp) => {
                app.messages = resp.data;
                app.loadingMessages = false;
                let thisIs = "#frame .content .messages";
                $(thisIs).animate({ scrollTop: $(thisIs + " ul").height() });
            })
        },
        sendMessage () {
            let app = this;
            app.sendingMessage = true;
            if (app.newMessage !== '') {
                axios.post(url + '/user/api/messages/send', {
                    sender_id: app.userID,
                    receiver_id: app.chatUserID,
                    message: app.newMessage,
                    project_id:app.project_id
                }).then((resp) => {
                    app.messages.push(resp.data);
                    app.newMessage = '';
                    app.sendingMessage = false;
                    let thisIs = "#frame .content .messages";
                    $(thisIs).animate({ scrollTop: $(thisIs + " ul").height() });
                })
            }
        }
    }
});
