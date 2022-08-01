<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">	
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">القائمة</li>

                    <!-- Dashboard -->
                    <li class="{{ isset($active) && $active == 'financial.home' ? 'active' : null }}">
                        <a href="{{ route('financial.home') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>لوحة التحكم</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Parents -->
                    <li class="{{ isset($active) && $active == 'parents' ? 'active' : null }}">
                        <a href="{{ route('financial.parents') }}">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>أولياء الأمور</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Students -->
                    <li class="{{ isset($active) && $active == 'students' ? 'active' : null }}">
                        <a href="{{ route('financial.students') }}">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الطلبة</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Rewards (For Instructors) -->
                    <li class="{{ isset($active) && $active == 'rewards-and-incentives-for-instructors' ? 'active' : null }}">
                        <a href="{{ route('financial.rewards-and-incentives-for-instructors') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>المكافآت و الحوافز</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Free Sessions -->
                    <li>
                        <a href="javascript:void(0);">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الحصص المجانية</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Expenses -->
                    <li class="{{ isset($active) && $active == 'expenses' ? 'active' : null }}">
                        <a href="{{ route('financial.expenses') }}">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>المصروفات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Reports -->
                    <li>
                        <a href="javascript:void(0);">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>التقارير</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="sidebar-footer">
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><span class="icon-Settings-2"></span></a>
        <a href="mailbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><span class="icon-Mail"></span></a>
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
    </div>
</aside>