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
                            <i class="ti-home">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>لوحة التحكم</span>
                        </a>
                    </li>

                    <!-- Educational Stages, Classes & Subjects -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>المراحل و المواد التعليمية</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'educational-stage' ? 'active' : null }}">
                                <a href="{{ route('admin.educational-stages') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    المراحل التعليمية
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'educational-classes' ? 'active' : null }}">
                                <a href="{{ route('admin.educational-classes') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الصفوف و الفصول
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'subjects' ? 'active' : null }}">
                                <a href="{{ route('admin.subjects') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    المواد التعليمية
                                </a>
                            </li>
                        </ul>
                    </li>

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
                                <a href="{{ route('admin.schedule-sessions') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض جميع الحصص
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'create-session' ? 'active' : null }}">
                                <a href="{{ route('admin.create-session') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء حصة جديدة
                                </a>
                            </li>
                            {{-- @php
                                $educationalStages = App\Models\EducationalStages\EducationalStage::get();
                            @endphp
                            @foreach ($educationalStages as $educationalStage)
                            <li class="{{ isset($active) && $active == 'education-stage-'.$educationalStage->slug ? 'active' : null }}">
                                <a href="{{ route('admin.schedule-sessions.educational-classes', $educationalStage->slug) }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    حصص {{ $educationalStage->name }}
                                </a>
                            </li>
                            @endforeach --}}
                        </ul>
                    </li>

                    <!-- Instructors -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>المدرسين</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'instructors' ? 'active' : null }}">
                                <a href="{{ route('admin.instructors') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    قائمة بجميع المدرسين
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'instructor.create' ? 'active' : null }}">
                                <a href="{{ route('admin.instructor.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء مدرس جديد
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الأذونات
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Parents -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>أولياء الأمور</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'parents' ? 'active' : null }}">
                                <a href="{{ route('admin.parents') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    قائمة أولياء الأمور
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'parent.create' ? 'active' : null }}">
                                <a href="{{ route('admin.parent.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء ولي امر جديد
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Students -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الطلبة</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'students' ? 'active' : null }}">
                                <a href="{{ route('admin.students') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    قائمة بجميع الطلبة
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'student.create' ? 'active' : null }}">
                                <a href="{{ route('admin.student.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء طالب جديد
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Financial Admins -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الإدارة المالية</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'financial-roles' ? 'active' : null }}">
                                <a href="{{ route('admin.financial-roles') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    جميع المديرين الماليين
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'financial-role.create' ? 'active' : null }}">
                                <a href="{{ route('admin.financial-role.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء مدير مالي جديد
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Labs -->
                    <li class="treeview">
                        <a href="javascript:void(0);">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>المعامل</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'labs' ? 'active' : null }}">
                                <a href="{{ route('admin.labs') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض جميع المعامل
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'lab.create' ? 'active' : null }}">
                                <a href="{{ route('admin.lab.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء معمل جديد
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

                    <!-- Exams -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>الامتحانات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'exams' ? 'active' : null }}">
                                <a href="{{ route('admin.exams') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض جميع الامتحانات
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'exam.create' ? 'active' : null }}">
                                <a href="{{ route('admin.exam.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء امتحان
                                </a>
                            </li>
                        </ul>
                    </li>

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

                    <!-- Rewards (For Instructors) -->
                    <li class="{{ isset($active) && $active == 'rewards-and-incentives-for-instructors' ? 'active' : null }}">
                        <a href="{{ route('admin.rewards-and-incentives-for-instructors') }}">
                            <i class="icon-Layout-4-blocks">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>المكافآت و الحوافز</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'exams' ? 'active' : null }}">
                                <a href="{{ route('admin.exams') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    عرض جميع الامتحانات
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'exam.create' ? 'active' : null }}">
                                <a href="{{ route('admin.exam.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء امتحان
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Free Sessions -->
                    <li>
                        <a href="{{ route('admin.free-sessions-for-students') }}">
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
                                <a href="{{ route('admin.library') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    الكتب
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'library.book.create' ? 'active' : null }}">
                                <a href="{{ route('admin.library.book.create') }}">
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

                    <!-- Expenses -->
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>المصروفات</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ isset($active) && $active == 'expenses' ? 'active' : null }}">
                                <a href="{{ route('admin.expenses') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    جميع المصروفات
                                </a>
                            </li>
                            <li class="{{ isset($active) && $active == 'expense.create' ? 'active' : null }}">
                                <a href="{{ route('admin.expense.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    انشاء خدمة جديدة
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Profits -->
                    <li>
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