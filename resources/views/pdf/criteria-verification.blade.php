<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หลักฐานตรวจสอบเกณฑ์การออกฝึกประสบการณ์วิชาชีพ</title>
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

        .field {
            margin: 10px 0;
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
        <h1>หลักฐานตรวจสอบเกณฑ์การออกฝึกประสบการณ์วิชาชีพ</h1>
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
                <td>หมู่เรียน</td>
                <td>{{ $student->section }}</td>
            </tr>
        </table>

        <h3>เกณฑ์การออกฝึกประสบการณ์วิชาชีพ</h3>

        <table>
            <tr>
                <th width="30%">เกณฑ์</th>
                <th width="40%">ข้อมูล</th>
                <th width="30%">สถานะ</th>
            </tr>
            <tr>
                <td>จำนวนวิชาเอกที่สอบผ่าน</td>
                <td>{{ $student->major_subjects_passed ?? '0' }} วิชา</td>
                <td>
                    @if(($student->major_subjects_passed ?? 0) >= 10)
                        <strong style="color: green;">✓ ผ่านเกณฑ์</strong>
                    @else
                        <strong style="color: red;">✗ ไม่ผ่านเกณฑ์</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td>เกรดวิชาเตรียมฝึกประสบการณ์วิชาชีพ</td>
                <td>{{ $student->pre_internship_grade ?? '-' }}</td>
                <td>
                    @if($student->pre_internship_grade && $student->pre_internship_grade != 'F')
                        <strong style="color: green;">✓ ผ่านเกณฑ์</strong>
                    @else
                        <strong style="color: red;">✗ ไม่ผ่านเกณฑ์</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td>ไฟล์หลักฐาน</td>
                <td>{{ $student->criteria_evidence_file ? 'มีการแนบไฟล์' : 'ยังไม่ได้แนบไฟล์' }}</td>
                <td>
                    @if($student->criteria_evidence_file)
                        <strong style="color: green;">✓ ครบถ้วน</strong>
                    @else
                        <strong style="color: red;">✗ ไม่ครบถ้วน</strong>
                    @endif
                </td>
            </tr>
        </table>

        <h3>สรุปผล</h3>
        <p style="font-size: 18pt; font-weight: bold;">
            @if(($student->major_subjects_passed ?? 0) >= 10 && $student->pre_internship_grade && $student->pre_internship_grade != 'F' && $student->criteria_evidence_file)
                <span style="color: green;">✓ ผ่านเกณฑ์การออกฝึกประสบการณ์วิชาชีพ</span>
            @else
                <span style="color: red;">✗ ยังไม่ผ่านเกณฑ์การออกฝึกประสบการณ์วิชาชีพ</span>
            @endif
        </p>
    </div>

    <div class="signature">
        <p>ลงชื่อ <span class="signature-line"></span> อาจารย์ผู้ตรวจสอบ</p>
        <p>(<span class="signature-line"></span>)</p>
        <p>วันที่ <span class="signature-line">{{ $generated_date }}</span></p>
    </div>
</body>

</html>