<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('dashboard')}}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu text-white">Navigation</span></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="key" class="feather-icon"></i><span
                            class="hide-menu">Global Codes </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @role('admin')
                            <li class="sidebar-item"><a href="{{ route('code.generate') }}" class="sidebar-link"><span
                                        class="hide-menu"> Générer
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('code.list') }}" class="sidebar-link"><span
                                        class="hide-menu"> Codes générés
                                    </span></a>
                            </li>

                        @endrole
                        <li class="sidebar-item"><a href="{{ route('code.transfer') }}" class="sidebar-link"><span
                                    class="hide-menu"> Transfert
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('code.transfer-history') }}" class="sidebar-link"><span
                                    class="hide-menu"> Historique des transferts
                                </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="globe" class="feather-icon"></i><span
                            class="hide-menu"> Communauté </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('network.users') }}" class="sidebar-link"><span
                                    class="hide-menu"> Membres
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('network.register') }}" class="sidebar-link"><span
                                    class="hide-menu"> Enregistrer
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('network.genealogy', ['user_id' => encrypt(Auth::id())]) }}" class="sidebar-link"><span
                                    class="hide-menu"> Arbre
                                </span></a>
                        </li>
                    </ul>
                </li>

                @role('admin')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">Groupes Leaders </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ route('leading-group.list') }}" class="sidebar-link"><span
                                        class="hide-menu"> Liste
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('leading-group.create') }}" class="sidebar-link"><span
                                        class="hide-menu"> Créer
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                @endrole


                @role('admin')
                            <li class="sidebar-item"><a href="{{ route('alldeposit') }}" class="sidebar-link"><span
                                        class="hide-menu"> Depots </span></a>
                            </li>
                        @endrole

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span
                            class="hide-menu">Retraits </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('withdrawal-request.submit') }}" class="sidebar-link"><span
                                    class="hide-menu"> Faire une demande
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('withdrawal-request.processed_history') }}" class="sidebar-link"><span
                                    class="hide-menu"> Traitées </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('withdrawal-request.not_processed_history') }}" class="sidebar-link"><span
                                    class="hide-menu"> Non traitées </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="activity" class="feather-icon"></i><span
                            class="hide-menu">Suivi </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('mark.recording-transaction-history') }}" class="sidebar-link"><span
                                    class="hide-menu"> Liste des ajouts
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('mark.bonuses-history') }}" class="sidebar-link"><span
                                    class="hide-menu"> Liste des bonus
                                </span></a>
                        </li>
                        @role('admin')
                            <li class="sidebar-item"><a href="{{ route('mark.action') }}" class="sidebar-link"><span
                                        class="hide-menu"> Toutes les actions </span></a>
                            </li>
                        @endrole
                    </ul>
                </li>

                @role('admin')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="refresh-ccw" class="feather-icon"></i><span
                                class="hide-menu">Optimisations </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ route('optimization.genealogy') }}" class="sidebar-link"><span
                                        class="hide-menu"> Refresh bonus & arbre
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('optimization.view') }}" class="sidebar-link"><span
                                        class="hide-menu"> Vues
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('optimization.cache') }}" class="sidebar-link"><span
                                        class="hide-menu"> Cache
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('optimization.config') }}" class="sidebar-link"><span
                                        class="hide-menu"> Config
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('optimization.url') }}" class="sidebar-link"><span
                                        class="hide-menu"> Routes
                                    </span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu text-white">Newsletter</span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('newsletter.index') }}"
                            aria-expanded="false">
                            <i data-feather="users" class="feather-icon"></i>
                            <spanclass="hide-menu text-white">Abonnés</span>
                        </a>
                    </li>
                @endrole

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu text-white">Compte</span></li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span
                            class="hide-menu">Déconnexion
                        </span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
