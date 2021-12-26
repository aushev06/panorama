document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        let images = document.querySelectorAll(".lazyload");
        new LazyLoad(images, {
            root: null,
            rootMargin: "400px",
            threshold: 0
        });

        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    }, 1000)






});
