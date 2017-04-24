// Use Morris.Area instead of Morris.Line
Morris.Donut({
    element: 'graph-donut',
    data: [
        {value: 40, label: '不活跃用户', formatted:'{$active_rate}' },
        {value: 60, label: '活跃用户', formatted:'60%'}
    ],
    backgroundColor: false,
    labelColor: '#fff',
    colors: [
        '#4acacb','#6a8bc0'
    ],
    formatter: function (x, data) { return data.formatted; }
});