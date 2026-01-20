<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปการฝึกประสบการณ์วิชาชีพ</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
        }

        body {
            font-family: 'THSarabunNew', sans-serif;
            font-size: 16pt;
            line-height: 1.6;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 22pt;
            font-weight: bold;
            margin: 5px 0;
        }

        .content {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .section-title {
            background-color: #e0e0e0;
            padding: 10px;
            margin-top: 20px;
            font-weight: bold;
            font-size: 18pt;
        }

        .status-pass {
            color: green;
            font-weight: bold;
        }

        .status-fail {
            color: red;
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .signature-line {
            display: inline-block;
            width: 250px;
            border-bottom: 1px dotted #000;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>รายงานสรุปการฝึกประสบการณ์วิชาชีพ</h1>
        <p>คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏเชียงใหม่</p>
        <p>สาขาวิชาวิทยาการคอมพิวเตอร์</p>
    </div>

    <div class="content">
        <!-- Student Information -->
        <div class="section-title">1. ข้อมูลนักศึกษา</div>
        <table>
            <tr>
                <th width="30%">รายการ</th>
                <th width="70%">ข้อมูล</th>
            </tr>
            <tr>
                <td>รหัสนักศึกษา</td>
                <td>{{ $student->student_id }}</td>
            </tr>
            <tr>
                <td>ชื่อ-นามสกุล</td>
                <td>{{ $student->title }} {{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            <tr>
                <td>หมู่เรียน</td>
                <td>{{ $student->section }}</td>
            </tr>
            <tr>
                <td>หมายเลขโทรศัพท์</td>
                <td>{{ $student->phone }}</td>
            </tr>
            <tr>
                <td>อีเมล</td>
                <td>{{ $student->user->email ?? '-' }}</td>
            </tr>
        </table>

        <!-- Company Information -->
        <div class="section-title">2. ข้อมูลหน่วยงาน</div>
        <table>
            <tr>
                <th width="30%">รายการ</th>
                <th width="70%">ข้อมูล</th>
            </tr>
            <tr>
                <td>ชื่อหน่วยงาน</td>
                <td>{{ $student->company_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td>{{ $student->company_address ?? '-' }}</td>
            </tr>
            <tr>
                <td>โทรศัพท์</td>
                <td>{{ $student->company_phone ?? '-' }}</td>
            </tr>
            <tr>
                <td>ตำแหน่งงาน</td>
                <td>{{ $student->job_position ?? '-' }}</td>
            </tr>
            <tr>
                <td>รายละเอียดงาน</td>
                <td>{{ $student->job_description ?? '-' }}</td>
            </tr>
        </table>

        <!-- Coordinator Information -->
        <div class="section-title">3. ข้อมูลผู้ประสานงาน</div>
        <table>
            <tr>
                <td width="30%">ชื่อ-นามสกุล</td>
                <td width="70%">{{ $student->coordinator_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>ตำแหน่ง</td>
                <td>{{ $student->coordinator_position ?? '-' }}</td>
            </tr>
            <tr>
                <td>โทรศัพท์</td>
                <td>{{ $student->coordinator_phone ?? '-' }}</td>
            </tr>
        </table>

        <!-- Criteria Verification -->
        <div class="section-title">4. การตรวจสอบเกณฑ์การออกฝึก</div>
        <table>
            <tr>
                <th width="40%">เกณฑ์</th>
                <th width="30%">ข้อมูล</th>
                <th width="30%">สถานะ</th>
            </tr>
            <tr>
                <td>จำนวนวิชาเอกที่สอบผ่าน</td>
                <td>{{ $student->major_subjects_passed ?? '0' }} วิชา</td>
                <td>
                    @if(($student->major_subjects_passed ?? 0) >= 10)
                        <span class="status-pass">✓ ผ่าน</span>
                    @else
                        <span class="status-fail">✗ ไม่ผ่าน</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>เกรดวิชาเตรียมฝึก</td>
                <td>{{ $student->pre_internship_grade ?? '-' }}</td>
                <td>
                    @if($student->pre_internship_grade && $student->pre_internship_grade != 'F')
                        <span class="status-pass">✓ ผ่าน</span>
                    @else
                        <span class="status-fail">✗ ไม่ผ่าน</span>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Hours Verification -->
        <div class="section-title">5. การตรวจสอบชั่วโมงฝึก</div>
        <table>
            <tr>
                <th width="40%">รายการ</th>
                <th width="30%">จำนวน</th>
                <th width="30%">หมายเหตุ</th>
            </tr>
            <tr>
                <td>วันขาดงาน</td>
                <td>{{ $student->absent_days ?? 0 }} วัน</td>
                <td>
                    @if(($student->absent_days ?? 0) > 3)
                        <span style="color: red;">เกินเกณฑ์</span>
                    @else
                        <span style="color: green;">ปกติ</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>วันมาสาย</td>
                <td>{{ $student->late_days ?? 0 }} วัน</td>
                <td>-</td>
            </tr>
            <tr>
                <td>วันลากิจ/ลาป่วย</td>
                <td>{{ $student->leave_days ?? 0 }} วัน</td>
                <td>-</td>
            </tr>
            <tr style="background-color: #ffffcc;">
                <td><strong>รวมชั่วโมงฝึก</strong></td>
                <td><strong>{{ $student->total_hours ?? 0 }} ชั่วโมง</strong></td>
                <td>
                    @if(($student->total_hours ?? 0) >= 320)
                        <span class="status-pass">✓ ผ่าน (≥320 ชม.)</span>
                    @else
                        <span class="status-fail">✗ ไม่ผ่าน (ต้อง 320 ชม.)</span>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Summary -->
        <div class="section-title">6. สรุปผลการฝึกประสบการณ์วิชาชีพ</div>
        <table>
            <tr>
                <td style="text-align: center; padding: 20px; font-size: 18pt;">
                    @php
                        $criteriaPass = ($student->major_subjects_passed ?? 0) >= 10 &&
                            $student->pre_internship_grade &&
                            $student->pre_internship_grade != 'F';
                        $hoursPass = ($student->total_hours ?? 0) >= 320;
                        $overallPass = $criteriaPass && $hoursPass;
                    @endphp

                    @if($overallPass)
                        <strong class="status-pass" style="font-size: 20pt;">
                            ✓ ผ่านการฝึกประสบการณ์วิชาชีพ
                        </strong>
                    @else
                        <strong class="status-fail" style="font-size: 20pt;">
                            ✗ ยังไม่ผ่านการฝึกประสบการณ์วิชาชีพ
                        </strong>
                        <br><br>
                        <span style="font-size: 14pt;">
                            @if(!$criteriaPass)
                                - ยังไม่ผ่านเกณฑ์การออกฝึก<br>
                            @endif
                            @if(!$hoursPass)
                                - ยังไม่ครบชั่วโมงฝึก (ขาดอีก {{ 320 - ($student->total_hours ?? 0) }} ชม.)<br>
                            @endif
                        </span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="signature">
        <table style="border: none; width: 100%;">
            <tr style="border: none;">
                <td style="border: none; width: 50%; text-align: center;">
                    <p>ลงชื่อ <span class="signature-line"></span></p>
                    <p>(<span class="signature-line"></span>)</p>
                    <p>อาจารย์ที่ปรึกษา</p>
                    <p>วันที่ <span class="signature-line"></span></p>
                </td>
                <td style="border: none; width: 50%; text-align: center;">
                    <p>ลงชื่อ <span class="signature-line"></span></p>
                    <p>(<span class="signature-line"></span>)</p>
                    <p>หัวหน้าสาขาวิชา</p>
                    <p>วันที่ <span class="signature-line"></span></p>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 14pt; color: #666;">
        <p>เอกสารนี้สร้างโดยระบบ Intern CMRU</p>
        <p>วันที่สร้าง: {{ $generated_date }}</p>
    </div>
</body>

</html>