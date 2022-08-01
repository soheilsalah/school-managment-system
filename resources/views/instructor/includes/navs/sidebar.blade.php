<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">	
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">القائمة</li>

                    <!-- Dashboard -->
                    <li class="{{ isset($active) && $active == 'instructor.home' ? 'active' : null }}">
                        <a href="{{ route('instructor.home') }}">
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

                    <!-- Educational Stages, Classes & Subjects -->
                    <li>
                        <a href="{{ route('instructor.educational-classes') }}">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>المراحل التعليمية</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Session Schedules -->
                    {{-- <li class="{{ isset($active) && $active == 'schedule-sessions' ? 'active' : null }}">
                        <a href="{{ route('instructor.schedule-sessions') }}">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الحصص</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li> --}}
                    
                   
                    <!-- Zoom Online Sessions -->
                    <!-- Session Schedules -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الحصص</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'schedule-sessions' ? 'active' : null }}">
                                <a href="{{ route('instructor.schedule-sessions') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض جميع الحصص
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'create-session' ? 'active' : null }}">
                                <a href="{{ route('instructor.create-session') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء حصة جديدة
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Recorded Sessions -->
                    <li>
                        <a href="javascript:void(0);">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الدروس المسجلة</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Excecises (Homeworks) -->
                    <li class="{{ isset($active) && $active == 'session-excersices' ? 'active' : null }}">
                        <a href="{{ route('instructor.session-excersices') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الواجبات المدرسية</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Rewards (For Instructors) -->
                    <li class="{{ isset($active) && $active == 'rewards-and-incentives-for-instructors' ? 'active' : null }}">
                        <a href="{{ route('instructor.rewards-and-incentives-for-instructors') }}">
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

                    <!-- Certificates -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الشهادات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء شهادة تقدير
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض جميع الشهادات
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Attendance & Absence -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الحضور و الغياب</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الحضور
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الغياب
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Library -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>المكتبات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'library' ? 'active' : null }}">
                                <a href="{{ route('instructor.library') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    جميع الكتب
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'library.my-books' ? 'active' : null }}">
                                <a href="{{ route('instructor.library.my-books') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    كتبي الشخصية
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'library.book.create' ? 'active' : null }}">
                                <a href="{{ route('instructor.library.book.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء كتاب جديد
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض المشتريات
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Profits -->
                    <li class="treeview">
                        <a href="javascript:void(0);">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الارباح</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'profit.my-books' ? 'active' : null}}">
                                <a href="{{ route('instructor.profits.my-books') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    كتبي الشخصية
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'profit.my-sessions' ? 'active' : null}}">
                                <a href="{{ route('instructor.profits.my-sessions') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الحصص
                                </a>
                            </li>
                        </ul>
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