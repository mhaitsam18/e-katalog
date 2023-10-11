var url = window.location.href.split('?')[0];
$('ul.navbar-nav a').filter(function() {
    return this.href == url;
}).parent().addClass('active');
$('ul.dropdown-menu a').filter(function() {
    return this.href == url;
}).parentsUntil('ul.navbar-nav nav-item ').addClass('active');
