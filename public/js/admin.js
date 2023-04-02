// change active item on sidebar menu
var sidebarMenu = document.getElementById('sidebarMenu');
var sidebarMenuItems = sidebarMenu.getElementsByTagName('a');
for (var i = 0; i < sidebarMenuItems.length; i++) {
    if (sidebarMenuItems[i].href === window.location.href) {
        sidebarMenuItems[i].classList.add('active');
    }
}