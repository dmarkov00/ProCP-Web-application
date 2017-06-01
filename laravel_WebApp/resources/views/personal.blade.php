<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>

    <link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

    <script src="js/script.js"></script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar" style="background-color: #fff;"></span>
                <span class="icon-bar" style="background-color: #fff;"></span>
                <span class="icon-bar" style="background-color: #fff;"></span>
            </button>
            <a class="navbar-brand" href="#myPage">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a id="modal_trigger" href="#modal">DOWNLOAD APP</a></li>
                <li><a href="#stats">STATISTICS</a></li>
                <li><a href="#logout" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="jumbotron text-center">
    <h1>WELCOME</h1>
    <p>{{$response->name}}</p>
</div>

<!-- Container (Services Section) -->
<div id="stats" class="container-fluid text-center">
    @if(isset($response->companyName))

    <div class="container">
        <h1>All deliveries. Filter with <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Developers</h3>
                        <div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                    </div>
                    <table class="table table-hover" id="dev-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Driver</th>
                            <th>Route</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>27/05</td>
                            <td>John</td>
                            <td>Paris-Eindhoven-Amsterdam</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>27/05</td>
                            <td>Ivan</td>
                            <td>Paris-Eindhoven-Amsterdam</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>27/05</td>
                            <td>Koko</td>
                            <td>Paris-Eindhoven-Amsterdam</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        @else
        <h1>Please register a company to see route information</h1>
    @endif
</div>


<!--this script makes use of the external leanModal plugin-->
<script>$("#modal_trigger").leanModal({top : 70, overlay : 0.6, closeButton: ".modal_close" });</script>

<!--All popup modals-->
<div id="modal" class="popupContainer" style="display:none;">
    <header class="popupHeader">
        <span class="header_title">Download Application</span>
        <span class="modal_close"><i class="fa fa-times"></i></span>
    </header>

    <section class="popupBody">

        <div class="social_login">

            <div class="centeredText">
                <span>Thank you for the truckst</span>
            </div>

            <div class="action_btns">
                <a class="btn downloadbtn" href="Test_Application.txt" download="Application">Download Application</a>
            </div>
        </div>

    </section>
</div>

<footer class="container-fluid text-center">
    <a href="#myPage" title="To Top">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>

</footer>

<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });

        $(window).scroll(function () {
            $(".slideanim").each(function () {
                var pos = $(this).offset().top;

                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });

        //search filter for personal page
        (function(){
            'use strict';
            var $ = jQuery;
            $.fn.extend({
                filterTable: function(){
                    return this.each(function(){
                        $(this).on('keyup', function(e){
                            $('.filterTable_no_results').remove();
                            var $this = $(this),
                                search = $this.val().toLowerCase(),
                                target = $this.attr('data-filters'),
                                $target = $(target),
                                $rows = $target.find('tbody tr');

                            if(search == '') {
                                $rows.show();
                            } else {
                                $rows.each(function(){
                                    var $this = $(this);
                                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                })
                                if($target.find('tbody tr:visible').size() === 0) {
                                    var col_count = $target.find('tr').first().find('td').size();
                                    var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
                                    $target.find('tbody').append(no_results);
                                }
                            }
                        });
                    });
                }
            });
            $('[data-action="filter"]').filterTable();
        })(jQuery);

        $(function(){
            // attach table filter plugin to inputs
            $('[data-action="filter"]').filterTable();

            $('.container').on('click', '.panel-heading span.filter', function(e){
                var $this = $(this),
                    $panel = $this.parents('.panel');

                $panel.find('.panel-body').slideToggle();
                if($this.css('display') != 'none') {
                    $panel.find('.panel-body input').focus();
                }
            });
            $('[data-toggle="tooltip"]').tooltip();
        })
    })
</script>

</body>
</html>
