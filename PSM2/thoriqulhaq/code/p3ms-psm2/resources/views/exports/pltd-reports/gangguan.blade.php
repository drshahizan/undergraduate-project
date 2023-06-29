<html>

    <table>
        <tr>
            <td colspan="10" style="{{$style['main_info']}}">LAPORAN {{ $type }} - {{ $power_plant['name'] }}</td>
        </tr>
        <tr>
            <td colspan="10" style="{{$style['secondary_info']}}">PERIODE: 01/06/2023 S.D 13/06/2023</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
    </table>
    
    <table style="{{$style['table']}}">
        <thead>
            <tr> 
                <th style="{{$style['header']}}">JAM / TANGGAL</th>
                <th style="{{$style['header']}}">DAYA TERPASANG</th>
                <th style="{{$style['header']}}">DAYA MAMPU</th>
                <th style="{{$style['header']}}">BEBAN</th>
                <th style="{{$style['header']}}">STAND AWAL</th>
                <th style="{{$style['header']}}">STAND AKHIR</th>
                <th style="{{$style['header']}}">KWH PRODUKSI</th>
                <th style="{{$style['header']}}">KEGIATAN HAR</th>
                <th style="{{$style['header']}}">GANGGUAN</th>
                <th style="{{$style['header']}}">DIBUAT</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td style="{{$style['body']}}">{{ $item->date_time }}</td>
                    <td style="{{$style['body']}}">{{ $item->installed_power }}</td>
                    <td style="{{$style['body']}}">{{ $item->ability }}</td>
                    <td style="{{$style['body']}}">{{ $item->load }}</td>
                    <td style="{{$style['body']}}">{{ $item->early_stand }}</td>
                    <td style="{{$style['body']}}">{{ $item->final_stand }}</td>
                    <td style="{{$style['body']}}">{{ $item->kwh_production }}</td>
                    <td style="{{$style['body']}}">{{ $item->har_activity }}</td>
                    <td style="{{$style['body']}}">{{ $item->maintenance }}</td>
                    <td style="{{$style['body']}}">{{ $item->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="{{$style['body']}}">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</html>