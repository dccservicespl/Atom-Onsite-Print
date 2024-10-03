<script>
    var navbarPosition = localStorage.getItem('navbarPosition');
    var navbarVertical = document.querySelector('.navbar-vertical');
    var navbarTopVertical = document.querySelector('.content .navbar-top');
    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

    if (localStorage.getItem('navbarPosition') === 'double-top') {
        document.documentElement.classList.toggle('double-top-nav-layout');
    }

    if (navbarPosition === 'top') {
        navbarTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTopCombo.remove(navbarTopCombo);
        navbarDoubleTop.remove(navbarDoubleTop);
    } else if (navbarPosition === 'combo') {
        navbarVertical.removeAttribute('style');
        navbarTopCombo.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarTopVertical.remove(navbarTopVertical);
        navbarDoubleTop.remove(navbarDoubleTop);
    } else if (navbarPosition === 'double-top') {
        navbarDoubleTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTop.remove(navbarTop);
        navbarTopCombo.remove(navbarTopCombo);
    } else {
        navbarVertical.removeAttribute('style');
        navbarTopVertical.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarDoubleTop.remove(navbarDoubleTop);
        navbarTopCombo.remove(navbarTopCombo);
    }
</script>
<footer class="footer">
    <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
        <div class="col-12 col-sm-auto text-center">
            
        </div>
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 text-600">Thank you for creating with <span class="d-none d-sm-inline-block">|
                </span><br class="d-sm-none" /> {{ date('Y') }} &copy;
                <a href="https://dccil.com/" target="_blank"> Data Consultants Corporation
                </a>
            </p>
        </div>
    </div>
</footer>
</div>
<div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
    aria-labelledby="authentication-modal-label" aria-hidden="true">
    <div class="modal-dialog mt-6" role="document">
        <div class="modal-content border-0">
            <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-1">
                    <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                    <p class="fs-10 mb-0 text-white">Please create your free Falcon account</p>
                </div><button class="btn-close position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 px-5">
                <form>
                    <div class="mb-3"><label class="form-label" for="modal-auth-name">Name</label><input
                            class="form-control" type="text" autocomplete="on" id="modal-auth-name" /></div>
                    <div class="mb-3"><label class="form-label" for="modal-auth-email">Email address</label><input
                            class="form-control" type="email" autocomplete="on" id="modal-auth-email" /></div>
                    <div class="row gx-2">
                        <div class="mb-3 col-sm-6"><label class="form-label"
                                for="modal-auth-password">Password</label><input class="form-control" type="password"
                                autocomplete="on" id="modal-auth-password" /></div>
                        <div class="mb-3 col-sm-6"><label class="form-label" for="modal-auth-confirm-password">Confirm
                                Password</label><input class="form-control" type="password" autocomplete="on"
                                id="modal-auth-confirm-password" /></div>
                    </div>
                    <div class="form-check"><input class="form-check-input" type="checkbox"
                            id="modal-auth-register-checkbox" /><label class="form-label"
                            for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a
                                class="white-space-nowrap" href="#!">privacy policy</a></label></div>
                    <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                            name="submit">Register</button></div>
                </form>
                <div class="position-relative mt-5">
                    <hr />
                    <div class="divider-content-center">or register with</div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-sm-6">
                        <a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#">
                            <span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span>
                            google
                        </a>
                    </div>
                    <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span
                                class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>
<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="/assets/vendors/popper/popper.min.js"></script>
<script src="/assets/vendors/bootstrap/bootstrap.min.js"></script>
<script src="/assets/vendors/anchorjs/anchor.min.js"></script>
<script src="/assets/vendors/is/is.min.js"></script>
<script src="/assets/vendors/echarts/echarts.min.js"></script>
<script src="/assets/vendors/fontawesome/all.min.js"></script>
<script src="/assets/vendors/lodash/lodash.min.js"></script>
{{-- <script src="../../../polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script> --}}
<script src="/assets/vendors/list.js/list.min.js"></script>
<script src="/assets/js/theme.js"></script>
{{-- //Datatable  --}}
<script src="/assets/vendors/jquery/jquery.min.js"></script>
<script src="/assets/vendors/datatables.net/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.min.js"></script>
<script src="/assets/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js"></script>


</body>

</html>
