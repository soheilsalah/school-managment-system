<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">	
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">القائمة</li>

                    <!-- Dashboard -->
                    <li class="{{ isset($active) && $active == 'student.home' ? 'active' : null }}">
                        <a href="{{ route('student.home') }}">
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
                   
                    <!-- Subscriptions Sessions -->
                    <li class="{{ isset($active) && $active == 'subscriptions' ? 'active' : null }}">
                        <a href="{{ route('student.subscriptions') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الاشتراكات</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Zoom Online Sessions -->
                    <li class="{{ isset($active) && $active == 'online-sessions' ? 'active' : null }}">
                        <a href="{{ route('student.online-sessions') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الدروس الاونلاين</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Recorded Sessions -->
                    {{-- <li>
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
                    </li> --}}

                    <!-- Exams -->
                    <li class="{{ isset($active) && $active == 'exams' ? 'active' : null }}">
                        <a href="{{ route('student.exams') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>الامتحانات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <!-- Labs -->
                    @php
                        $student = App\Models\Students\Student::where('id', Auth::guard('student')->user()->id)->first();
                        $countLabInEducationalClass = App\Models\Labs\Lab::where('educational_class_id', $student->belongsToStudentClass->belongsToEducationalClass->id)->count();
                    @endphp
                    @if($countLabInEducationalClass > 0)
                    <li class="{{ isset($active) && $active == 'labs' ? 'active' : null }}">
                        <a href="{{ route('student.labs') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>
                                المعامل
                            </span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>
                    @endif

                    <!-- Excecises (Homeworks) -->
                    <li>
                        <a href="javascript:void(0);">
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

                    <!-- Certificates -->
                    <li>
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الشهادات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
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
                            <li class="{{ isset($active) && $active == 'attendance' ? 'active' : null }}">
                                <a href="{{ route('student.attendance') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الحضور
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'abscences' ? 'active' : null }}">
                                <a href="{{ route('student.abscences') }}">
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
                                <a href="{{ route('student.library') }}">
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