/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DataMining;

import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.TreeMap;

import jxl.Cell;
import jxl.Sheet;
import jxl.Workbook;
import jxl.read.biff.BiffException;

import static DataMining.Sim.getSimilarity;
import static DataMining.ReadExcel.frequent1;
import static DataMining.ReadExcel.frequent2;


/**
 *
 * @author LH
 */
public class test {
	
    public static void main(String[] args) throws Exception{
    	String[] destSongs;
    	//事先设定好excel表格中各簇的首尾行
    	int lines[][]={{1,140},{141,236},{237,344},{345,476},{477,602},{603,723},{724,865},{866,979},{980,1091},{1092,1257},{1258,1406},{1407,1516},{1517,1620},{1621,1717},{1718,1834},{1835,1991},{1992,2084},{2085,2226},{2227,2313},{2314,2500}};
    	//输入备选歌曲
    	k_summary summary = new k_summary();
    	destSongs = summary.getDestsong();
//    	for(int i=0;i<5;i++){
//    		System.out.println(destSongs[i]);
//    	}
    	
    	//获得簇序号
    	int cluster = summary.getBestCluster(destSongs);  	
    	System.out.println(cluster);
    	//String[] destSongs={"葡萄成熟时","陈奕迅","U-87","情歌,流行,80后,粤语,现场","差不多冬至一早一晚还是有雨当初的坚持现已令你很怀疑很怀疑你最尾等到只有这枯枝苦恋几多次悉心栽种全力灌注所得竟不如别个后辈收成时这一次你真的很介意但见旁人谈情何引诱问到何时葡萄先熟透你要静候再静候就算失收始终要守日后尽量别教今天的泪白流留低击伤你的石头从错误里吸收也许丰收月份尚未到你也得接受或者要到你将爱酿成醇酒时机先至熟透应该怎么爱可惜书里从没记载终于摸出来但岁月却不回来不回来错过了春天可会再花开一千种恋爱一些需要情泪灌溉枯毁的温柔在最后会长回来错的爱乃必经的配菜但见旁人谈情何引诱问到何时葡萄先熟透你要静候再静候就算失收始终要守日后尽量别教今天的泪白流留低击伤你的石头从错误里吸收也许丰收月份尚未到你也得接受或者要到你将爱酿成醇酒时机先至熟透想想天的一边亦有个某某在等候 一心只等葡萄熟透尝杯酒 别让寂寞害你伤得一夜白头仍得不需要的自由和最耀眼伤口我知日后路上或没有更美的邂逅但当你智慧都蕴酿成红酒仍可一醉自救谁都辛酸过哪个没有"};
    	
    	String reaAlbum="",reaSinger="",reaTags="",reaLyric="",reaTitle=""; 	
    	jxl.Workbook readwb = null; 
    	InputStream instream = new FileInputStream("C:\\Users\\hs5\\Desktop\\聚类结果.xls");
    	try {
			readwb = Workbook.getWorkbook(instream);			
		} catch (BiffException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} 
		Sheet readsheet = readwb.getSheet(0);
		
		int start = lines[cluster-1][0];
		int end = lines[cluster-1][1];
		//double[] similarity=new double[end-start+1];
		Map<String, Double> map = new TreeMap<String, Double>();
		for(int i=start;i<=end;i++){
			Cell cell = readsheet.getCell(2, i);
			reaAlbum = cell.getContents();
			cell = readsheet.getCell(0, i);
			reaTitle = cell.getContents();
			cell = readsheet.getCell(1, i);
			reaSinger = cell.getContents();
			cell = readsheet.getCell(3, i);
			reaTags = cell.getContents();
			cell = readsheet.getCell(5, i);
			reaLyric = cell.getContents();
			//System.out.println(reaLyric);
	    	double singerSim = getSingerSim(destSongs[1],reaSinger);
	    	//System.out.println("歌手相似度"+singerSim);
	    	double albumSim = getAlbumSim(destSongs[2],reaAlbum);
	    	//System.out.println("专辑相似度"+albumSim);
	    	double tagsSim = getTagsSim(destSongs[3],reaTags);
	    	//System.out.println("标签相似度"+tagsSim);
	    	double lyricSim = getLyricSimility(destSongs[4],reaLyric);
	        double result = singerSim+albumSim+lyricSim*10+tagsSim*2;
	        //System.out.println("总相似度"+result);
	        map.put(reaTitle, result);
		}
		
		/*遍历map*/
		/*
		for(Map.Entry<String, Double> entry:map.entrySet()){    
		     System.out.println(entry.getKey()+"--->"+entry.getValue());    
		} */
		
		List<Map.Entry<String,Double>> list = new ArrayList<Map.Entry<String,Double>>(map.entrySet());
		Collections.sort(list,new Comparator<Map.Entry<String,Double>>() {
	            //升序排序
	        public int compare(Entry<String, Double> o1,Entry<String, Double> o2) {
	            return o1.getValue().compareTo(o2.getValue())*(-1);
	        }
	    });
		
		/*排序后遍历*/
		int count=10;
		for(Map.Entry<String,Double> mapping:list){ 
			if (count==0) {
				break;				
			}else{
				System.out.println(mapping.getKey()+":"+mapping.getValue()); 
				count--;
			}
        } 
		/*
        //double[] orderedSim = order(similarity);
		for(int i=0;i<similarity.length;i++){
			System.out.println(similarity[i]);
		}
        Arrays.sort(similarity);
        System.out.println("分割线");
        for(int i=0;i<similarity.length;i++){
			System.out.println(similarity[i]);
		}
        //List<Double> list=Arrays.asList(similarity);  
        //System.out.println(list.get(0));
        //System.out.println(orderedSim[0]);
        */
         
    }

	private static double getTagsSim(String desTags, String reaTags) {
		// TODO Auto-generated method stub
    	String[] desTagsArray = desTags.split(" ");
    	String[] reaTagsArray = reaTags.split(" ");
    	int interact = countInteract(desTagsArray,reaTagsArray);
    	int union = desTagsArray.length+reaTagsArray.length-interact;
		return interact*1.0/union;
	}

	private static int countInteract(String[] desTagsArray, String[] reaTagsArray) {
		// TODO Auto-generated method stub
		int result=0;
		for(int i=0;i<desTagsArray.length;i++){
			for(int j=0;j<reaTagsArray.length;j++){
				if (desTagsArray[i].equals(reaTagsArray[j])) {
					result++;
					break;
				}
			}
		}
		return result;
	}

	private static double getAlbumSim(String desAlbum, String reaAlbum) {
		// TODO Auto-generated method stub
    	if(desAlbum.equals(reaAlbum)){
    		return 1;
    	}else{
    		return 0;
    	}	
	}

	public static double getLyricSimility(String desLyric,String reaLyric) throws IOException{
    	Sim sim = new Sim();
    	ArrayList<String> texts = new ArrayList<String>();
    	 //   texts.add("香云纱其实是一种经过特殊处理的丝绸，它从明代永乐年间开始生产，二十世纪二三十年代达到顶峰，被当时的上海滩富豪视为高贵的服饰。在那个时代的老电影中，你不难发现它的身影。但是在上个世纪的五十年代以后，它作为消费“奢侈品”开始逐渐销声匿迹，在历史的长河中渐渐被人遗忘，这项古老的生产工艺也几近失传。直到2008年国家把这种独特的纱线染整技术确认为国家级的非物质文化遗产并且对之加以推广，这种古老的面料才慢慢地为重新回到大家的视线。");
    //    texts.add("香云纱是目前纺织品中极少数的使用纯植物染料染色的桑蚕丝绸织物。它是一种用广东特有的植物薯莨的汁水浸染桑蚕丝织物，再用顺德伦教地区特有的富含多种矿物质的河涌淤泥覆盖，经反复日晒加工而成的一种昂贵的绿色环保纱绸织品。经过处理后的织物厚度增加约30%，重量增加约40%。由于受生产制造特殊性的影响（手工，气候，薯莨植被等），产量很少，更显得珍稀。因为附着了矿物塘泥，香云纱穿上身后感觉凉爽，遇水快干，且不容易抽丝和起皱。同时，由于薯莨本身就是一种中药，有清热化瘀的功效，还有防霉、除菌、除臭等功效，所以用香云纱做成的衣服也具有相同的“医用”效果。由于受天气等自然影响和手工制作的局限，所以面料上会有少量的黑斑、红斑及白痕，属正常现象，这也正是区别于赝品的特殊标识。");
       // texts.add("期末复习备考攻略");
 //       texts.add("六级复习备战期末");
       // texts.add("苍狼大地作词：布赫敖斯尔作曲：腾格尔演唱：HAYA乐团太阳在南北回归线间徘徊牧人在温带草原上游荡太阳在南北回归线间徘徊牧人在温带草原上游荡我曾经听说过游牧人是大陆的主人啊哈...哪呼...哪呼...hmm啊哈...哪呼...哪呼...hmm太阳移来又移去万物生长又消失狼狗失去了主人猎狗失去了骏马人间已过几百年我昔日的主人你现在在哪里啊哈...哪呼...哪呼...hmm啊哈...哪呼...哪呼...hmm太阳在南北回归线间徘徊牧人在温带草原上游荡太阳在南北回归线间徘徊牧人在温带草原上游荡太阳在南北回归线间徘徊牧人在温带草原上游荡太阳在南北回归线间徘徊牧人在温带草原上游荡");
       // texts.add("狼图腾作词：安华作曲：乌兰托嘎演唱：汤非牧归的路上 祥云飘过母亲把我带到人间天堂第一次睁开睁开眼睛看到父亲满脸的沧桑摇篮系在马背上童年的伙伴是快乐的牛羊听着牧歌深情悠扬马头琴声伴我成长这是蒙古汉子崇拜的图腾智慧的狼心中流淌成吉思汗的精血与雄鹰一起一起飞翔住在那洁白的毡房沐浴着灿烂的阳光大草原放牧我的心情牧歌在我的心中荡漾传承父辈父辈的酒量牧马人的胆气豪情万丈风风雨雨学会坚韧骁勇善战铸就顽强这是蒙古汉子崇拜的图腾智慧的狼心中流淌成吉思汗的精血与雄鹰一起一起飞翔一起飞翔");
     //  texts.add("(蒙古文)：洁白的毡房炊烟升起洁白的毡房炊烟升起我出生在牧人家里辽阔的草原是哺育我成长的摇篮养育我的这片土地当我身躯一样爱惜沐浴我的那江河水母亲的乳汁一样甘甜这就是蒙古人热爱故乡的人"); 
         texts.add(desLyric);
        texts.add(reaLyric);
    	double s = sim.getSimilarity(texts,150);
        //System.out.println("歌词相似度"+s);
        return s;
    }
    
    public static double getSingerSim(String desSinger,String reaSinger){
    	if(desSinger.contains(reaSinger) || reaSinger.contains(desSinger)){
    		return 1;
    	}else{
    		return 0;
    	}
    }
    
}
