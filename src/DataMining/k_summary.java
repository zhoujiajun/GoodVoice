package DataMining;

import java.io.BufferedReader;
import java.io.File;    
import java.io.IOException;
import java.io.InputStreamReader;

import jxl.Cell;  
import jxl.Sheet;  
import jxl.Workbook;  

import java.util.List;
import java.util.LinkedList;

public class k_summary {
	 public static void main(String[] args) throws Exception {
		 k_summary k=new k_summary();
		 String[] c=k.getDestsong();
		 System.out.println(k.getBestCluster(c));
		 
	 }

public String[] getDestsong() throws IOException{
	String[] destSong=new String[5];
	BufferedReader stdin = new BufferedReader(new InputStreamReader(System.in));
    System.out.println("请输入歌曲名称：");
	destSong[0]=stdin.readLine();;
	System.out.println("请输入歌手名称：");
	destSong[1]=stdin.readLine();;
	System.out.println("请输入歌曲所属专辑名称：");
	destSong[2]=stdin.readLine();;                	             	
	System.out.println("请输入歌曲标签：");
	destSong[3]=stdin.readLine();;               
	System.out.println("请输入歌词：");
	destSong[4]=stdin.readLine();;
	
	return destSong;

}
public int getBestCluster(String[] DestSong) throws Exception {
	//===========================获得分好簇的Excel=
	File file = new File("C:\\Users\\hs5\\Desktop\\聚类结果.xls");   
    Workbook wb = Workbook.getWorkbook(file);  
    Sheet[] sheets = wb.getSheets();
    Sheet s=sheets[0];
    int rows = s.getRows();
    String[] clusters=new String[rows];//获得每一行歌曲的簇序号
    String[] u_cluster=new String[50];//获得一个簇集合，
    String[][] tag=new String[50][10000];
    String str;
    int Clusternum;
    //======================================================将每一行的簇序号存入cluster字符数组
    if(rows > 0){
        for(int i = 1 ;i < rows ; i++){
            
            Cell[] cells = s.getRow(i);  
            	  Cell c=cells[4];
                    clusters[i] = c.getContents().trim();
                    
               }
            } 
    //==========================================================对cluster进行去重复，存入到u_cluster中
    List<String> list=new LinkedList<String>();
	   for(int i=1;i<clusters.length;i++){
		   if(!list.contains(clusters[i])){
			   list.add(clusters[i]);
			
		   }
		   
	   }
	   u_cluster=(String[])list.toArray(new String[list.size()]);
	//========================================================== 对每个簇的标签装入一个tag[][]钟
	   
	   for(int l=0;l<u_cluster.length;l++){
		   
      	 int p_count=0;
         if(rows > 0){
          for(int i = 0 ;i < rows ; i++){
              
              Cell[] cells = s.getRow(i);  
              	  Cell c1=cells[3];
              	  Cell c2=cells[4];
                      String contents = c1.getContents().trim();
                      String cluster = c2.getContents().trim();
                      if(cluster.contains(u_cluster[l])){
                      p_count=splitTag(l,contents,p_count,tag);}
                     
                     
                 
                       
              }     
          
          }
         }
      //======================================================================================
         double[] result=new double[u_cluster.length];
         String[] DestTag=new String[10];
         int tagNum;
         tagNum=splitDestSongTag(DestSong[3],DestTag);
         double[] freq=new double[tagNum+3];
         for(int p=0;p<u_cluster.length;p++){//------------------------------这里开始计算每个簇的k-summary
         	
         	         	 if(rows > 0){
              Clusternum=getClusterNum(clusters,u_cluster[p]);//获得每一个簇里面的歌曲数目
              for(int i=0;i<Clusternum;i++){
             	 for(int m=0;m<3;m++){
             		 
             		 freq[m]=frequent1(m,rows,DestSong,s,u_cluster[p]);
             		
             	 }
             	
             	 for(int m=3;m<tagNum+3;m++){
             		 freq[m]=frequent2(p,tag,DestTag[m-3]);
                    
             	}
              }
              result[p]=ksummary(freq,tagNum, Clusternum);
            // System.out.println(result[p]);   
         }
       }//--------------------------------------------------------------------------K-summary计算完毕
         
         int i=BestCluster(result);
         str=u_cluster[i];
         str=str.trim();
         String str2="";
         if(str != null && !"".equals(str)){
         for(int j=0;j<str.length();j++){
         if(str.charAt(j)>=48 && str.charAt(j)<=57){
         str2+=str.charAt(j);
         }
         }}
	     return Integer.valueOf(str2);
}//==================================================================================


private int splitTag(int m,String str,int p_count,String[] tag[]) {//分割字符串
	int istr = str.length();
	String str1 = str.replaceAll("[ ]", ""); 
	int istr1 = str1.length();
	int count=istr - istr1;
	String[] ary = str.split(" ");
	for(int i=0;i<=count;i++){
		tag[m][p_count++]=ary[i];
		
	}
	
	return p_count;
}
private int splitDestSongTag(String str,String[] DestTag){
	int CountTag;
	int istr = str.length();
	String str1 = str.replaceAll("[ ]", ""); 
	int istr1 = str1.length();
	CountTag=istr - istr1;
	String[] ary = str.split(" ");
	for(int i=0;i<=CountTag;i++){
		DestTag[i]=ary[i];
		
		
	}

	return CountTag+1;
}
private int getClusterNum(String[] a,String clusterName) {
	 int clusterNum=0;      
 	
	   for(int i=1;i<a.length;i++){
		   if(a[i].contains(clusterName)){
			   clusterNum++;
		   }
       }
	   return clusterNum;
}


private double frequent1(int i,int rows,String[] song,Sheet s,String u_cluster){
	double freq=0;
	if(rows > 0){  
        for(int a1 = 0 ;a1 < rows ; a1++){
        Cell[] cells = s.getRow(a1);  
      	  Cell c1=cells[i];
      	  Cell c2=cells[4];
      	  String target=song[i];
      	  String contents=c1.getContents().trim();
      	  String cluster=c2.getContents().trim();
    
      	  if(u_cluster.contains(cluster)){
      		 
      	  if(target.contains(contents)){

      		  freq++;
      	  }
      	  }
      	  }
        }
	return freq;
	}
private double frequent2(int i,String[][] tag,String DestSongTag){
	 double freq=0;
	 List<String> list=new LinkedList<String>();
	 list.add(DestSongTag);
	   
	   for(int j=0;j<tag[i].length;j++){//计算目标这个输入的属性在一个类中占的频率。
	
		   if(list.contains(tag[i][j])){
			   freq++;
			  
		   }
	   }
	 return freq;
}
private double ksummary(double[] freq,int num,int Clusternum){//ClusterNum为簇的大小
	double sum=0;
	for(int i=3;i<num+3;i++){//歌曲将标签所有的频率相加
		freq[i]=1-(freq[i]/Clusternum);
		sum+=freq[i];
	}
	for(int i=0;i<3;i++){//歌曲专辑，歌名以及歌手信息的频率
		freq[i]=1-(freq[i]/Clusternum);
	}
	double re=0.6*freq[1]+0.3*freq[2]+0.1*(sum/num);//赋予权值，将所有的频数相加
	//System.out.println(re+"     ");
	return re;
}
private int BestCluster(double[] k){//===============================================求k-summary值最大的簇
	double min=1000000;
	int mark=0;
	for(int i=0;i<k.length;i++){
		if(k[i]<min){
			min=k[i];
			mark=i;
		}
	}
	return mark;
}
}
	 

