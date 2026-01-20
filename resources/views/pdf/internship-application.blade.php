<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบสมัครฝึกประสบการณ์วิชาชีพ</title>
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

        .header p {
            margin: 3px 0;
        }

        .content {
            margin: 20px 0;
        }

        .field {
            margin: 10px 0;
        }

        .field-label {
            display: inline-block;
            width: 200px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature-line {
            display: inline-block;
            width: 250px;
            border-bottom: 1px dotted #000;
            margin: 0 10px;
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
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>แบบฟอร์มสมัครฝึกประสบการณ์วิชาชีพ</h1>
        <p>คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏเชียงใหม่</p>
        <p>สาขาวิชาวิทยาการคอมพิวเตอร์</p>
    </div>

    <div class="content">
        <h3>ข้อมูลนักศึกษา</h3>

        <div class="field">
            <span class="field-label">รหัสนักศึกษา:</span>
            <span>{{ $student->student_id }}</span>
        </div>

        <div class="field">
            <span class="field-label">ชื่อ-นามสกุล:</span>
            <span>{{ $student->title }} {{ $student->first_name }} {{ $student->last_name }}</span>
        </div>

        <div class="field">
            <span class="field-label">หมู่เรียน:</span>
            <span>{{ $student->section }}</span>
        </div>

        <div class="field">
            <span class="field-label">หมายเลขโทรศัพท์:</span>
            <span>{{ $student->phone }}</span>
        </div>

        <div class="field">
            <span class="field-label">อีเมล:</span>
            <span>{{ $student->user->email ?? '-' }}</span>
        </div>

        <h3>ข้อมูลหน่วยงาน</h3>

        <div class="field">
            <span class="field-label">ชื่อหน่วยงาน:</span>
            <span>{{ $student->company_name ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">ตำแหน่งงาน:</span>
            <span>{{ $student->job_position ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">รายละเอียดงาน:</span>
            <p>{{ $student->job_description ?? '-' }}</p>
        </div>

        <div class="field">
            <span class="field-label">ที่อยู่หน่วยงาน:</span>
            <p>{{ $student->company_address ?? '-' }}</p>
        </div>

        <div class="field">
            <span class="field-label">โทรศัพท์หน่วยงาน:</span>
            <span>{{ $student->company_phone ?? '-' }}</span>
        </div>

        <h3>ข้อมูลผู้ประสานงาน</h3>

        <div class="field">
            <span class="field-label">ชื่อ-นามสกุล:</span>
            <span>{{ $student->coordinator_name ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">ตำแหน่ง:</span>
            <span>{{ $student->coordinator_position ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">โทรศัพท์:</span>
            <span>{{ $student->coordinator_phone ?? '-' }}</span>
        </div>

        <h3>ข้อมูลผู้มีอำนาจอนุมัติ</h3>

        <div class="field">
            <span class="field-label">ชื่อ-นามสกุล:</span>
            <span>{{ $student->authorized_person_name ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">ตำแหน่ง:</span>
            <span>{{ $student->authorized_person_position ?? '-' }}</span>
        </div>
    </div>

    <div class="signature">
        <p>ลงชื่อ <span class="signature-line"></span> นักศึกษา</p>
        <p>(<span class="signature-line">{{ $student->title }} {{ $student->first_name }}
                {{ $student->last_name }}</span>)</p>
        <p>วันที่ <span class="signature-line">{{ $generated_date }}</span></p>
    </div>
</body>

</html>