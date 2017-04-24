import xlrd
import urllib.request
import xlwt
import re

# 读取excel
file_name = "E:\大三上\数据挖掘\大作业\song.xls"
# 打开文件
bk = xlrd.open_workbook(file_name)
shxrange = range(bk.nsheets)

xls = xlwt.Workbook()
sheet = xls.add_sheet("Sheet1")
# 打开数据表
try:
    sh = bk.sheet_by_name("Sheet1")
except:
    print("no sheet in %s named Sheet1") % file_name
for i in range(1, 382):
    value = sh.cell_value(i, 5)
    if value:
        print(value)

        response = urllib.request.urlopen(value)
        content = response.read()
        new_content = content.decode("utf8")

        #reobj = re.compile("\[\w*\]")

        reobj = re.compile("\[[^\[]*\]")
        real_value = reobj.sub(" ", new_content)
        real_value = real_value.replace(" \n","")
# 爬虫
        print(real_value)
        sheet.write(i, 0, real_value)

# 获取excel

# 获得数据表

# 写入


#数据整理


# 保存文件
fname = "E:\大三上\数据挖掘\大作业\lyric.xls"
xls.save(fname)

