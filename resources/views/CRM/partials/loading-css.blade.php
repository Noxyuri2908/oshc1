<style>
    /* Absolute Center Spinner */
    .loading-fixed-top {
        display: none;
        position: fixed;
        /*z-index: 999;*/
        /*height: 2em;*/
        /*width: 2em;*/
        /*overflow: visible;*/
        margin: auto;
        top: 28px;
        /*left: 0;*/
        /*bottom: 0;*/
        right: 1px;
        width: 50px;
        height: 50px;
    }

    /* Transparent Overlay */
    /*.loading-fixed-top:before {*/
    /*    content: '';*/
    /*    display: block;*/
    /*    position: fixed;*/
    /*    top: 0;*/
    /*    left: 0;*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*    background-color: rgba(0,0,0,0.3);*/
    /*}*/

    /* :not(:required) hides these rules from IE9 and below */
    .loading-fixed-top:not(:required) {
        /* hide "loading-fixed-top..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .loading-fixed-top:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 1500ms infinite linear;
        -moz-animation: spinner 1500ms infinite linear;
        -ms-animation: spinner 1500ms infinite linear;
        -o-animation: spinner 1500ms infinite linear;
        animation: spinner 1500ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
    }

    /* Animation */

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .bottom-text .form-row > div[class*="col-"]{
        background: #fff 0% 0% no-repeat padding-box;
        border: 0.5px solid #707070;
        border-radius: 5px;
        opacity: 1;
        margin-right: 13px;
    }

    .bottom-text .form-row > div[class*="col-"] > a{
        text-align: left;
        font: normal normal bold 12px/16px Segoe UI;
        letter-spacing: 0px;
        opacity: 1;
        font-size: 12px;
        text-decoration: none;
    }

    .bottom-text .form-row > div[class*="col-"]:hover,
    .bottom-text .form-row > div.active{
        background: #2C7BE5 0% 0% no-repeat padding-box;
        border: 0.5px solid #2C7BE5;
        border-radius: 5px;
        opacity: 1;
    }

    .bottom-text .form-row > div[class*="col-"]:hover > a > span,
    .bottom-text .form-row > div.active > a > span{
        color: #fff !important;
    }


    .bottom-text .form-row > div[class*="col-"] > a > span {
        color: #707070;
        font-weight: normal;
    }
</style>
