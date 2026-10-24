<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Users & Settings (المستخدمين والإعدادات)</title>
    <!-- سطر مكتبة Alpine.js للتفاعل -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome 6 Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amankDark: '#0B1730',
                        amankBlue: '#1769FF',
                        amankBg: '#F3F6FB',
                        amankRed: '#E53935',
                        amankGreen: '#16A579',
                        amankAmber: '#F59E0B',
                        amankSidebarHover: '#132347'
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 4px 20px -2px rgba(11, 23, 48, 0.05)',
                        'glow-blue': '0 8px 25px -5px rgba(23, 105, 255, 0.4)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #F3F6FB; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="h-full flex overflow-hidden text-slate-800 antialiased">

    <!-- ===== SHARED SIDEBAR ===== -->
    @include('sidebar')

    <!-- ===== MAIN CONTAINER ===== -->
    <div class="flex-1 flex min-w-0 overflow-hidden">

        <!-- ===== CENTER: USERS TABLE & MANAGEMENT ===== -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between shrink-0 z-10 shadow-sm">
                <div class="flex items-center gap-3">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-800">إدارة المستخدمين والصلاحيات (Users & Settings)</h2>
                        <p class="text-[10px] text-slate-400 font-semibold">تحكم في حسابات المشغلين، الصلاحيات الأمنية، وإعدادات النظام</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="bg-amankBlue text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-blue-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i> إضافة مستخدم جديد
                    </button>
                </div>
            </header>

            <!-- Main Content Body -->
            <main class="flex-1 overflow-y-auto p-5 space-y-5">
                
                <!-- Search & Filters Bar -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-2 flex-1 min-w-[240px]">
                        <div class="relative w-full">
                            <input type="text" placeholder="بحث بالاسم أو البريد الإلكتروني..." class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pr-9 pl-3 py-2 focus:outline-none focus:border-amankBlue">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-slate-400 text-xs"></i>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold">
                        <select class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:border-amankBlue">
                            <option>جميع الأدوار الوظيفية</option>
                            <option>مدير النظام (Admin)</option>
                            <option>مراقب غرفة العمليات</option>
                            <option>مسؤول أسطول</option>
                        </select>
                    </div>
                </div>

                <!-- Users Master Table -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right text-xs">
                            <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100">
                                <tr>
                                    <th class="p-3.5">المستخدم</th>
                                    <th class="p-3.5">البريد الإلكتروني</th>
                                    <th class="p-3.5">الدور الوظيفي</th>
                                    <th class="p-3.5">آخر تسجيل دخول</th>
                                    <th class="p-3.5 text-center">حالة الحساب</th>
                                    <th class="p-3.5 text-center">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                                @forelse($users ?? [] as $user)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3.5 flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-blue-100 text-amankBlue flex items-center justify-center font-bold">ص</div>
                                        <span class="font-extrabold text-slate-900">{{ $user->name ?? 'م. صبحي يوسف' }}</span>
                                    </td>
                                    <td class="p-3.5 text-slate-500">{{ $user->email ?? 'sobhi@amank.gov.eg' }}</td>
                                    <td class="p-3.5 font-bold text-amankBlue">{{ $user->role ?? 'مدير غرفة العمليات العام' }}</td>
                                    <td class="p-3.5 text-slate-500">منذ دقيقة واحدة</td>
                                    <td class="p-3.5 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">نشط</span></td>
                                    <td class="p-3.5 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تعديل</button></td>
                                </tr>
                                @empty
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3.5 flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-blue-100 text-amankBlue flex items-center justify-center font-bold">ص</div>
                                        <span class="font-extrabold text-slate-900">م. صبحي يوسف</span>
                                    </td>
                                    <td class="p-3.5 text-slate-500">sobhi@amank.gov.eg</td>
                                    <td class="p-3.5 font-bold text-amankBlue">مدير غرفة العمليات العام</td>
                                    <td class="p-3.5 text-slate-500">منذ دقيقة واحدة</td>
                                    <td class="p-3.5 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">نشط</span></td>
                                    <td class="p-3.5 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تعديل</button></td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3.5 flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold">م</div>
                                        <span class="font-extrabold text-slate-900">مارينا عاطف</span>
                                    </td>
                                    <td class="p-3.5 text-slate-500">marina@amank.gov.eg</td>
                                    <td class="p-3.5 font-bold text-slate-700">محلل ومختبر أنظمة QA</td>
                                    <td class="p-3.5 text-slate-500">منذ ساعتين</td>
                                    <td class="p-3.5 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">نشط</span></td>
                                    <td class="p-3.5 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تعديل</button></td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3.5 flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-amber-100 text-amankAmber flex items-center justify-center font-bold">ي</div>
                                        <span class="font-extrabold text-slate-900">يسى مهندس</span>
                                    </td>
                                    <td class="p-3.5 text-slate-500">yassa@amank.gov.eg</td>
                                    <td class="p-3.5 font-bold text-slate-700">مسؤول البنية والـ Backend</td>
                                    <td class="p-3.5 text-slate-500">منذ 5 ساعات</td>
                                    <td class="p-3.5 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">نشط</span></td>
                                    <td class="p-3.5 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تعديل</button></td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3.5 flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-amankRed flex items-center justify-center font-bold">ف</div>
                                        <span class="font-extrabold text-slate-900">فرح وائل</span>
                                    </td>
                                    <td class="p-3.5 text-slate-500">farah@amank.gov.eg</td>
                                    <td class="p-3.5 font-bold text-slate-700">مطور واجهات前端</td>
                                    <td class="p-3.5 text-slate-500">أمس</td>
                                    <td class="p-3.5 text-center"><span class="px-2.5 py-1 bg-amber-50 text-amankAmber border border-amber-200 rounded-full text-[10px] font-bold">إجازة</span></td>
                                    <td class="p-3.5 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تعديل</button></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>

        <!-- ===== RIGHT PANEL: QUICK SETTINGS & OPERATORS ===== -->
        <div class="w-80 bg-white border-r border-slate-200 flex flex-col shrink-0 z-20 shadow-xl overflow-y-auto">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-amankBlue bg-blue-100 px-2 py-0.5 rounded-full">إعدادات النظام العامة</span>
                    <h3 class="text-sm font-black text-slate-800 mt-1">فريق العمليات النشط</h3>
                </div>
            </div>

            <div class="p-4 space-y-4 text-xs">
                <!-- Operators List -->
                <div class="space-y-2">
                    <span class="font-bold text-slate-400 block text-[11px]">المشغلون المتواجدون الآن:</span>
                    
                    <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-amankGreen animate-pulse"></div>
                            <span class="font-bold text-slate-800">م. صبحي يوسف</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-semibold">متصل</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-amankGreen animate-pulse"></div>
                            <span class="font-bold text-slate-800">مارينا عاطف</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-semibold">متصل</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-amankGreen animate-pulse"></div>
                            <span class="font-bold text-slate-800">يسى مهندس</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-semibold">متصل</span>
                    </div>
                </div>

                <!-- General System Preferences -->
                <div class="space-y-3 pt-2 border-t border-slate-100">
                    <span class="font-bold text-slate-400 block text-[11px]">تفضيلات الطوارئ التلقائية:</span>
                    
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-slate-700">التوجيه الآلي للوحدات:</span>
                        <input type="checkbox" checked class="accent-amankBlue w-4 h-4 cursor-pointer">
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-slate-700">تنبيهات الطوارئ الصوتية:</span>
                        <input type="checkbox" checked class="accent-amankBlue w-4 h-4 cursor-pointer">
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-slate-700">وضع الصيانة الليلية:</span>
                        <input type="checkbox" class="accent-amankBlue w-4 h-4 cursor-pointer">
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <button class="w-full bg-amankDark text-white py-2.5 rounded-xl font-bold shadow-md hover:bg-slate-800 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> حفظ كافة الإعدادات
                    </button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>