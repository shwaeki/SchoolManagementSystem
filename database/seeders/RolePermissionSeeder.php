<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view-list-user' => 'عرض قائمة المستخدمين',
            'view-user' => 'عرض مستخدم',
            'create-user' => 'اضافة مستخدم',
            'update-user' => 'تحديث مستخدم',
            'destroy-user' => 'حذف مستخدم',

            'view-list-role' => 'عرض قائمة الدور',
            'view-role' => 'عرض دور',
            'create-role' => 'اضافة دور',
            'update-role' => 'تحديث دور',
            'destroy-role' => 'حذف دور',

            'view-list-permission' => 'عرض قائمة الصلاحيات',
            'view-permission' => 'عرض صلاحية',
            'create-permission' => 'اضافة صلاحية',
            'update-permission' => 'تحديث صلاحية',
            'destroy-permission' => 'حذف صلاحية',

            'view-list-student-requests' => 'عرض قائمة طلبات الطلاب',
            'accept-student-request' => 'قبول طلب الطالب',
            'view-list-student' => 'عرض قائمة الطلاب',
            'view-archive-students-list' => 'عرض قائمة الطلاب المؤرشفة',
            'view-student' => 'عرض طالب',
            'view-student-files' => 'عرض ملفات طالب',
            'view-student-reports' => 'عرض تقارير طالب',
            'create-student-report' => 'اضافة تقرير جديد',
            'view-student-attendances' => 'عرض حضور طالب',
            'view-student-sms' => 'عرض رسائل طالب',
            'view-student-history' => 'عرض سجل التعديل للطالب',
            'view-student-classes' => 'عرض فصول الطالب ',
            'update-student-classes' => 'تعديل فصول الطالب',
            'destroy-student-classes' => 'حذف فصول الطالب',
            'view-student-sales' => 'عرض المبيعات للطالب',
            'create-student-purchases' => 'اضافة طلب شراء طالب',
            'destroy-student-purchases' => 'حذف  طلب شراء طالب',
            'update-student-purchases' => 'تعديل طلب شراء طالب',
            'create-student-payments' => 'اضافة دفعة طالب جديدة',
            'destroy-student-payments' => 'حذف دفعة طالب',
            'update-student-payments' => 'تعديل دفعة طالب',
            'create-student' => 'اضافة طالب',
            'update-student' => 'تحديث طالب',
            'archive-student' => 'ارشفة طالب',
            'destroy-student' => 'حذف طالب',

            'view-list-teacher-list' => 'عرض قائمة المعلمين',
            'view-archive-teachers-list' => 'عرض قائمة المعلمين المؤرشفة',
            'view-teacher-attendance' => 'عرض حضور المعلم',
            'view-teacher' => 'عرض المعلم',
            'view-teacher-files' => 'عرض ملفات المعلم',
            'view-teacher-sms' => 'عرض رسائل المعلم',
            'view-teacher-reports' => 'عرض تقارير المعلم',
            'view-teacher-report' => 'عرض تقارير المعلم',
            'create-teacher-report' => 'اضافة تقرير جديد',
            'view-teacher-salary-sheet' => 'عرض  قسيمة الراتب للمعلم',
            'destroy-teacher-salary-sheet' => 'حذف قسيمة الراتب للمعلم',
            'create-teacher-salary-sheet' => 'اضافة قسيمة الراتب للمعلم',
            'update-teacher-salary-sheet' => 'تعديل قسيمة الراتب للمعلم',
            'create-teacher' => 'اضافة معلم',
            'update-teacher' => 'تحديث معلم',
            'destroy-teacher' => 'حذف معلم',
            'archive-teacher' => 'ارشفة معلم',
            'view-teacher-monthly-reports' => 'عرض تقارير الشهرية للمعلم',
            'create-teacher-monthly-report' => 'اضافة تقرير الشهرية للمعلم',
            'update-teacher-monthly-report' => 'تحديث تقرير الشهرية للمعلم',
            'destroy-teacher-monthly-report' => 'حذف تقرير الشهرية للمعلم',


            'view-list-academic-year' => 'عرض قائمة السنوات الدراسية',
            'view-academic-year' => 'عرض سنة دراسية',
            'create-academic-year' => 'اضافة سنة دراسية',
            'update-academic-year' => 'تحديث سنة دراسية',
            'destroy-academic-year' => 'حذف سنة دراسية',

            'view-list-school-class' => 'عرض قائمة الفصول الدراسية',
            'view-archive-school-class-list' => 'عرض قائمة الفصول الدراسية المؤرشفة',
            'view-school-class' => 'عرض فصل دراسي',
            'view-school-class-class-years' => 'عرض سنوات الفصل',
            'view-school-class-attendances' => 'عرض حضور طلاب الفصل',
            'view-school-class-daily-reports' => 'عرض تقارير اليومية للفصل',
            'create-school-class-daily-report' => 'اضافة تقرير اليومية للفصل',
            'update-school-class-daily-report' => 'تحديث تقرير اليومية للفصل',
            'destroy-school-class-daily-report' => 'حذف تقرير اليومية للفصل',

            'view-school-class-weekly-reports' => 'عرض تقارير الاسبوعية للفصل',
            'create-school-class-weekly-report' => 'اضافة تقرير الاسبوعية للفصل',
            'update-school-class-weekly-report' => 'تحديث تقرير الاسبوعية للفصل',
            'destroy-school-class-weekly-report' => 'حذف تقرير الاسبوعية للفصل',

            'view-school-class-monthly-reports' => 'عرض تقارير الشهرية للفصل',
            'create-school-class-monthly-report' => 'اضافة تقرير الشهرية للفصل',
            'update-school-class-monthly-report' => 'تحديث تقرير الشهرية للفصل',
            'destroy-school-class-monthly-report' => 'حذف تقرير الشهرية للفصل',

            'view-school-class-posts' => 'عرض المنشورات للفصل',
            'create-school-class-post-for-all' => 'اضافة منشور لكل الفصول',
            'create-school-class-post' => 'اضافة منشور للفصل',
            'update-school-class-post' => 'تحديث منشور للفصل',
            'destroy-school-class-post' => 'حذف منشور للفصل',

            'view-school-class-students' => 'عرض طلاب الفصل',
            'update-school-class-student-certificate' => 'تحديث شهادة طالب في الفصل',
            'view-school-class-student-certificate' => 'عرض شهادة طالب في الفصل',
            'create-school-class-student' => 'اضافة طالب للفصل',
            'destroy-school-class-student' => 'حذف طالب من الفصل',
            'update-school-class-student' => 'تعديل طالب في الفصل',

            'create-school-class' => 'اضافة فصل دراسي',
            'update-school-class' => 'تحديث فصل دراسي',
            'destroy-school-class' => 'حذف فصل دراسي',
            'archive-school-class' => 'ارشفة فصل دراسي',

            'view-list-certificates' => 'عرض قائمة الشهادات',
            'view-certificates' => 'عرض شهادات',
            'create-certificates' => 'اضافة شهادة',
            'update-certificates' => 'تحديث شهادة',
            'destroy-certificates' => 'حذف شهادة',

            'view-list-teachers-attendances' => 'عرض حضور المعلم',
            'view-teachers-attendance' => 'عرض حضور المعلم',
            'create-teachers-attendance' => 'اضافة حضور المعلم',
            'update-teachers-attendance' => 'تحديث حضور المعلم',
            'destroy-teachers-attendance' => 'حذف حضور المعلم',

            'view-list-products' => 'عرض قائمة المنتجات',
            'view-products' => 'عرض منتج',
            'create-products' => 'اضافة منتج',
            'update-products' => 'تحديث منتج',
            'destroy-products' => 'حذف منتج',

            'view-list-reports' => 'عرض قائمة التقارير',
            'create-report' => 'اضافة تقرير',
            'update-report' => 'تحديث تقرير',
            'destroy-report' => 'حذف تقرير',

            'view-list-salary-sheet' => 'عرض قسائم الرواتب الرواتب',
            'split-salary-sheet' => 'تقسيم الرواتب للمعلمين',
            'create-salary-sheet' => 'اضافة قسيمة راتب',
            'update-salary-sheet' => 'تحديث قسيمة راتب',
            'destroy-salary-sheet' => 'حذف قسيمة راتب',

            'update-settings' => 'تحديث الاعدادات',
            'send-sms' => 'ارسال رسالة نصية قصيرة',
            'chats' => 'المحادثات',
            'advertising' => 'الاعلانات',
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $key, 'display_name' => $permission]);
        }

        // $admin = Role::create(['name' => 'super-admin']);
        //  $admin->syncPermissions($permissions);


        /*   $user = User::factory()->create([
               'name' => 'Super Admin',
               'email' => 'admin@email.com',
               'email_verified_at' => now(),
               'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
               'remember_token' => Str::random(10),
           ]);*/


        //  $user->assignRole($admin);
        //  $user->syncPermissions($permissions);


    }
}
