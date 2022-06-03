<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <title>Google Event</title>
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            position: relative;
            overflow: scroll;
            height: 32em;
            max-height: 32em;
        }

        .table-main-agent table, .table-div table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        .table-main-agent td,
        .table-main-agent th,
        .table-div td,
        .table-div th {
            padding: 0.25em;
        }

        thead th {
            font-size: 0.83rem;
        }

        thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #007bff;
            color: #fff;
        }

        thead .last-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }

        .top-80 {
            top: 25px;
        }

        .last-row th {
            top: 25px;
        }

        .table-div thead.customer-thead th input, .table-div thead.customer-thead th select, .table-div tbody th, .table-div tbody td {
            font-size: 0.83rem;
        }

        .table-main-agent thead.customer-thead .first-row th:first-child,
        .table-main-agent thead.customer-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(2),
        .table-main-agent thead.customer-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(3),
        .table-main-agent thead.customer-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(4),
        .table-main-agent thead.customer-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(5),
        .table-main-agent thead.customer-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(6),
        .table-main-agent thead.customer-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(7),
        .table-main-agent thead.customer-thead .last-row th:nth-child(7) {
            left: 490px;
            z-index: 2;
        }

        .table-main-agent tbody .first-col {
            left: 0;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .second-col {
            left: 40px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .third-col {
            left: 90px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .fourth-col {
            left: 190px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody tr td:nth-child(5) {
            left: 290px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody tr td:nth-child(6) {
            left: 390px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody tr td:nth-child(7) {
            left: 490px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .sticky-col {
            position: sticky;
        }

        /* tbody th {*/
        /*    position: -webkit-sticky;*/
        /*    position: sticky;*/
        /*    left: 0;*/
        /*    background: #FFF;*/
        /*    border-right: 1px solid #CCC;*/
        /*}*/
        tbody th, tbody td {
            border-bottom: 1px solid #ccc;
        }

        .width-40 {
            width: 40px;
        }

        .width-50 {
            width: 50px;
        }

        .width-80 {
            width: 80px;
        }

        .width-220 {
            width: 220px;
        }

        .width-170 {
            width: 170px;
        }

        .width-200 {
            width: 200px;
        }

        .width-500 {
            width: 500px;
        }

        .width-300 {
            width: 300px;
        }

        .width-100 {
            width: 100px;
        }

        .width-120 {
            width: 120px;
        }

        .text-overflow {
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .white-space-pre-text {
            white-space: pre;
        }

        .bg-pale-gray {
            background-color: #eae7e7
        }

        .table-div select {
            padding: 0 20px;
        }

        #sale_task .card-body {
            padding: 0.5%;
        }

        #sale_task h5 {
            font-family: 'roboto', sans-serif !important;
            font-weight: 600;
        }

        .process-hover-dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>

</head>
<body>
    <div id="app">
        <div class="table-market-feedback table-div" v-on:scroll="handleScroll">
            <table class="">
                <thead class="">
                    <tr class="first-row">
                        <th class="width-80">Action</th>
                        <th class="width-200">First Name</th>
                        <th class="width-220">Last Name</th>
                    </tr>
                    <tr class="last-row">
                        <th></th>
                        <th>
                            <input type="text" class="form-control" id="first_name_fitler" placeholder="Agent">
                        </th>
                        <th>
                            <input type="text" class="form-control" id="last_name_fitler" placeholder="Agent">
                        </th>
                    </tr>
                </thead>
                <tbody id="market-feedback-data-sale" >
                    <tr v-for="(data,index) in tableData">
                        <td>@{{ data.id }}</td>
                        <td>@{{ data.first_name }}</td>
                        <td>@{{ data.last_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="modal_market_feedback_form">

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        new Vue({
            el: '#app',
            data:{
                tableData:'',
                lastPage:'',
                currentPage:''
            },
            methods:{
                getList(){
                    axios.get('getCustomer')
                    .then(response=>{
                        if(response.status == 200){
                            this.tableData = response.data.data;
                            this.lastPage = response.data.last_page;
                            this.currentPage = response.data.current_page
                        }
                    })
                    .catch(error=>{
                        console.log(error);
                    })
                },
                handleScroll(event){
                    //console.log('top:'+document.body.scrollTop+'height:'+window.innerHeight+'width'+window.innerWidth);
                    console.log(event.target.scrollTop );
                    Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80
                }
            },
            created(){
                this.getList();
            }
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
