(function () {
    'use strict';
    const btnViewHide = document.querySelector('#btn-view-hide');

    if (btnViewHide) {
        btnViewHide.addEventListener('click', function (e) {
            document.querySelectorAll('.tb-view-action').forEach(item => {
                item.classList.toggle('d-none');
            });

            let icon = btnViewHide.querySelector('svg');
            let span = btnViewHide.querySelector('span');
            let obj = document.querySelector('.tb-view-action.d-none');
            if (obj) {
                if (icon.classList.contains('fa-eye-slash')) {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
                span.innerHTML = "mostra";
            } else {
                if (icon.classList.contains('fa-eye')) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
                span.innerHTML = "oculta";
            }

        })
    }

    document.querySelectorAll('.tooltip-demo')
        .forEach(function (tooltip) {
            new bootstrap.Tooltip(tooltip, {
                selector: '[data-bs-toggle="tooltip"]'
            })
        })

    document.querySelectorAll('[data-bs-toggle="popover"]')
        .forEach(function (popover) {
            new bootstrap.Popover(popover)
        })

    document.querySelectorAll('.toast')
        .forEach(function (toastNode) {
            var toast = new bootstrap.Toast(toastNode, {
                autohide: false
            })

            toast.show()
        })


    function setActiveItem() {
        var hash = window.location.hash

        if (hash === '') {
            return
        }

        var link = document.querySelector('.bd-aside a[href="' + hash + '"]')

        if (!link) {
            return
        }

        var active = document.querySelector('.bd-aside .active')
        var parent = link.parentNode.parentNode.previousElementSibling

        link.classList.add('active')

        if (parent.classList.contains('collapsed')) {
            parent.click()
        }

        if (!active) {
            return
        }

        var expanded = active.parentNode.parentNode.previousElementSibling

        active.classList.remove('active')

        if (expanded && parent !== expanded) {
            expanded.click()
        }
    }

    setActiveItem()
    window.addEventListener('hashchange', setActiveItem)
})();
