<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลหน่วยงานฝึกประสบการณ์วิชาชีพ</title>
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
    </style>
</head>

<body>
    <div class="header">
        <h1>ข้อมูลหน่วยงานฝึกประสบการณ์วิชาชีพ</h1>
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
        </table>

        <h3>ข้อมูลหน่วยงาน</h3>
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
                <td>หมายเลขโทรศัพท์</td>
                <td>{{ $student->company_phone ?? '-' }}</td>
            </tr>
            <tr>
                <td>พิกัด Google Maps</td>
                <td>{{ $student->google_map_coords ?? '-' }}</td>
            </tr>
        </table>

        <h3>ข้อมูลตำแหน่งงาน</h3>
        <table>
            <tr>
                <th width="30%">รายการ</th>
                <th width="70%">ข้อมูล</th>
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

        <h3>ข้อมูลผู้ประสานงาน</h3>
        <table>
            <tr>
                <th width="30%">รายการ</th>
                <th width="70%">ข้อมูล</th>
            </tr>
            <tr>
                <td>ชื่อ-นามสกุล</td>
                <td>{{ $student->coordinator_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>ตำแหน่ง</td>
                <td>{{ $student->coordinator_position ?? '-' }}</td>
            </tr>
            <tr>
                <td>หมายเลขโทรศัพท์</td>
                <td>{{ $student->coordinator_phone ?? '-' }}</td>
            </tr>
        </table>

        <h3>ข้อมูลผู้มีอำนาจอนุมัติ</h3>
        <table>
            <tr>
                <th width="30%">รายการ</th>
                <th width="70%">ข้อมูล</th>
            </tr>
            <tr>
                <td>ชื่อ-นามสกุล</td>
                <td>{{ $student->authorized_person_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>ตำแหน่ง</td>
                <td>{{ $student->authorized_person_position ?? '-' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>