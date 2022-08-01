<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">	
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">القائمة</li>

                    <!-- Dashboard -->
                    <li class="{{ isset($active) && $active == 'admin.home' ? 'active' : null }}">
                        <a href="{{ route('admin.home') }}">
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

                    <!-- Subscription for each parent's student -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الاشتراكات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @php
                                $parentStudents = App\Models\Parents\StudentParent::where('id', Auth::guard('parent')->user()->id)->first()->students;
                            @endphp
                            @foreach ($parentStudents as $parentStudent)
                            <li class="{{ isset($active) && $active == 'student-subscription-'.$parentStudent->belongsToStudent->slug ? 'active' : null }}">
                                <a href="{{ route('parent.subscriptions', $parentStudent->belongsToStudent->slug) }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    {{ $parentStudent->belongsToStudent->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Schedule Session fo each parent's students -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الحصص</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @php
                                $parentStudents = App\Models\Parents\StudentParent::where('id', Auth::guard('parent')->user()->id)->first()->students;
                            @endphp
                            @foreach ($parentStudents as $parentStudent)
                            <li class="{{ isset($active) && $active == 'student-session-'.$parentStudent->belongsToStudent->slug ? 'active' : null }}">
                                <a href="{{ route('parent.student.sessions', $parentStudent->belongsToStudent->slug) }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    {{ $parentStudent->belongsToStudent->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Students -->
                    <li class="{{ isset($active) && $active == 'students' ? 'active' : null }}">
                        <a href="{{ route('parent.students') }}">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>طلابي</span>
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
                                    انشاء شهادة تخرج
                                </a>
                            </li>
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
                                <a href="{{ route('parent.library') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    جميع الكتب
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