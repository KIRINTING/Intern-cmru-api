<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หลักฐานตรวจสอบชั่วโมงฝึกประสบการณ์วิชาชีพ</title>
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
            font-size: 20pt;
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

        .highlight {
            background-color: #ffffcc;
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
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
        <h1>หลักฐานตรวจสอบชั่วโมงฝึกประสบการณ์วิชาชีพ</h1>
        <p>คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏเชียงใหม่</p>
    </div>

    <div class="content">
        <h3>ข้อมูลนักศึกษา</h3>

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
                <td>อีเมล</td>
                <td>{{ $student->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>หน่วยงาน</td>
                <td>{{ $student->company_name ?? '-' }}</td>
            </tr>
        </table>

        <h3>สรุปชั่วโมงฝึกประสบการณ์วิชาชีพ</h3>

        <table>
            <tr>
                <th width="50%">รายการ</th>
                <th width="25%">จำนวน</th>
                <th width="25%">หมายเหตุ</th>
            </tr>
            <tr>
                <td>จำนวนวันที่ขาดงาน</td>
                <td style="text-align: center;">{{ $student->absent_days ?? 0 }} วัน</td>
                <td>
                    @if(($student->absent_days ?? 0) > 3)
                        <span style="color: red;">เกินเกณฑ์</span>
                    @else
                        <span style="color: green;">ปกติ</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>จำนวนวันที่มาสาย</td>
                <td style="text-align: center;">{{ $student->late_days ?? 0 }} วัน</td>
                <td>
                    @if(($student->late_days ?? 0) > 5)
                        <span style="color: orange;">ควรปรับปรุง</span>
                    @else
                        <span style="color: green;">ปกติ</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>จำนวนวันที่ลากิจ/ลาป่วย</td>
                <td style="text-align: center;">{{ $student->leave_days ?? 0 }} วัน</td>
                <td>
                    @if(($student->leave_days ?? 0) > 5)
                        <span style="color: orange;">ควรติดตาม</span>
                    @else
                        <span style="color: green;">ปกติ</span>
                    @endif
                </td>
            </tr>
            <tr class="highlight">
                <td><strong>จำนวนชั่วโมงฝึกทั้งหมด</strong></td>
                <td style="text-align: center;"><strong>{{ $student->total_hours ?? 0 }} ชั่วโมง</strong></td>
                <td>
                    @if(($student->total_hours ?? 0) >= 320)
                        <strong style="color: green;">✓ ผ่านเกณฑ์</strong>
                    @else
                        <strong style="color: red;">✗ ไม่ผ่านเกณฑ์ (ต้อง 320 ชม.)</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td>ไฟล์หลักฐาน</td>
                <td colspan="2">{{ $student->hours_evidence_file ? '✓ มีการแนบไฟล์' : '✗ ยังไม่ได้แนบไฟล์' }}</td>
            </tr>
        </table>

        <h3>สรุปผล</h3>
        <p style="font-size: 18pt; font-weight: bold;">
            @if(($student->total_hours ?? 0) >= 320 && $student->hours_evidence_file)
                <span style="color: green;">✓ ผ่านเกณฑ์ชั่วโมงฝึกประสบการณ์วิชาชีพ</span>
            @else
                <span style="color: red;">✗ ยังไม่ผ่านเกณฑ์ชั่วโมงฝึกประสบการณ์วิชาชีพ</span>
            @endif
        </p>

        @if(($student->total_hours ?? 0) < 320)
            <p style="color: red;">
                * ยังขาดอีก {{ 320 - ($student->total_hours ?? 0) }} ชั่วโมง
            </p>
        @endif
    </div>

    <div class="signature">
        <p>ลงชื่อ <span class="signature-line"></span> อาจารย์ผู้ตรวจสอบ</p>
        <p>(<span class="signature-line"></span>)</p>
        <p>วันที่ <span class="signature-line">{{ $generated_date }}</span></p>
    </div>
</body>

</html>