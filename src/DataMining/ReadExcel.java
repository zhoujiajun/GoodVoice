package DataMining;

import java.io.File;    

import jxl.Cell;  
import jxl.Sheet;  
import jxl.Workbook;  

import java.util.List;
import java.util.LinkedList;
import java.util.Scanner;
  


public class ReadExcel {  
	public static final int num=1000;
	static String[] tag[ ] = new String[100][num];
    public String[] decideCu() throws Exception {
    	  
        File file = new File("C:\\Users\\hs5\\Desktop\\music111.xls");
        
        Workbook wb = Workbook.getWorkbook(file);  
        Sheet[] sheets = wb.getSheets();  
       
            
                Sheet s=sheets[0];
            
                int rows = s.getRows();
                String[] clusters=new String[rows];
                int Clusternum;
                String[] u_cluster=new String[30];
                u_cluster=getCluster(clusters,rows,s);
               //--------------------------------------------------将属性即歌曲标签分开，分到二维数组tag里面（不除重复）
                for(int l=0;l<u_cluster.length;l++){
                	 int p_count=0;
                if(rows > 0){
                    for(int i = 0 ;i < rows ; i++){
                        
                        Cell[] cells = s.getRow(i);  
                        	  Cell c1=cells[3];
                        	  Cell c2=cells[4];
                                String contents = c1.getContents().trim();
                                String cluster = c2.getContents().trim();
                                if(cells[3]!=null){
                                if(cluster.contains(u_cluster[l])){
                                p_count=splitChar(l,contents,p_count,tag);}
                           }
                        } 
                    //System.out.println();  
                    
                    }
                
                }  
                //--------------------------------------------------------------------------------------------------------------
                
                
                
                //============================================输入歌曲信息
                
				Scanner cin=new Scanner(System.in);
                System.out.println("请输入歌曲的标签数目：");
                int number=cin.nextInt();
                System.out.println();
                String[] song=new String[number+3];
                double[] freq=new double[20];
                for(int j=0;j<number+3;j++){
            		freq[j]=0;
            	}
                    int j=0;
                	System.out.println("请输入歌曲所属专辑名称：");
                	song[j++]=cin.next();
                	System.out.println("请输入歌曲名称：");
                	song[j++]=cin.next();
                	System.out.println("请输入歌手名称：");
                	song[j++]=cin.next();                	
                	             	
                	System.out.println("请输入歌曲标签：");
                	for(int a=3;a<number+3;a++){
                		song[a]=cin.next();
                		
                	}//===============================================================输入信息完毕
                	
                double[] result=new double[u_cluster.length];
                for(int l=0;l<u_cluster.length;l++){//------------------------------这里开始计算每个簇的k-summary
                	
                	System.out.println();
                	 if(rows > 0){
                     Clusternum=getClusterNum(clusters,u_cluster[l]);
                     for(int i=0;i<Clusternum;i++){
                    	 for(int m=0;m<3;m++){
                    		 
                    		 freq[m]=frequent1(m,rows,song,s,u_cluster[l]);
                    	 }
                    	 for(int m=3;m<number+3;m++){
                    		 freq[m]=frequent2(l,tag,song[m]);
                    	 }
                     }
                     result[l]=k_summary(freq,number, Clusternum);   	 
                     System.out.println("目标歌曲与"+u_cluster[l]+"的距离为"+result[l]);
                }
         
       
    }//--------------------------------------------------------------------------K-summary计算完毕
                System.out.println();
                int ooo=getBestCluster(result);
                System.out.println("该目标歌曲归入到"+u_cluster[ooo]+"中");
                cin.close();
                return song;
         }
 
    
    
    
    
    
    
    
    
    
    
    public static double frequent1(int i,int rows,String[] song,Sheet s,String u_cluster){//================计算专辑歌手及歌名在一个簇中的频数
    	double freq=0;
    	if(rows > 0){  
            for(int a1 = 0 ;a1 < rows ; a1++){
            	Cell[] cells = s.getRow(a1);  
          	  Cell c1=cells[i];
          	  Cell c2=cells[4];
          	  String contents=c1.getContents().trim();
          	  String cluster=c2.getContents().trim();
          	  if(contents.contains(song[i])&&cluster.contains(u_cluster)){
          		  freq++;
          	  }
          		  
          	  }
            }
    	
    	return freq;
    }
    public static double frequent2(int m,String[] tag[],String song){//===============================计算歌曲标签的频数
  	   double freq=0;
	   List<String> list=new LinkedList<String>();
	   list.add(song);
	   
	   for(int i=0;i<tag[m].length;i++){//计算目标这个输入的属性在一个类中占的频率。
		   if(list.contains(tag[m][i])){
			   freq++;
			  
		   }
	   }
	
  	 return freq;
  	  
    }
  //====================================================K-summary
    public static double k_summary(double[] freq,int num,int Clusternum){//ClusterNum为簇的大小
    	double sum=0;
    	for(int i=3;i<num+3;i++){//歌曲将标签所有的频率相加
    		freq[i]=1-(freq[i]/Clusternum);
    		sum+=freq[i];
    	}
    	for(int i=0;i<3;i++){//歌曲专辑，歌名以及歌手信息的频率
    		freq[i]=1-(freq[i]/Clusternum);
    	}
    	double re=0.3*freq[0]+0.05*freq[1]+0.35*freq[2]+0.3*(sum/num);//赋予权值，将所有的频数相加
    	                                                              
    	return re;
    }
    public static int splitChar(int m,String info,int p_count,String[] tag[]){//================================================分割标签 
    	
    	String str=info;
        	int istr = str.length();
        	String str1 = str.replaceAll("[,]", ""); 
        	int istr1 = str1.length();
        	int count=istr - istr1;
        	String[] ary = str.split("\\,");
        	for(int i=0;i<=count;i++){
        		
        		tag[m][p_count++]=ary[i];
        	}
        	
        	return p_count;
        }
    public static String[] array_unique(String[] a){//==============================================将所有簇存在unique字符数组中
 	   
 	   List<String> list=new LinkedList<String>();
 	   for(int i=1;i<a.length;i++){
 		   if(!list.contains(a[i])){
 			   list.add(a[i]);
 		   }
 	   }
 	   return (String[])list.toArray(new String[list.size()]);
    }
    public static String[] getCluster(String[] clusters,int rows,Sheet s){
    	 //=======================================================================================得到存储簇的数组
        if(rows > 0){
            for(int i = 1 ;i < rows ; i++){
                
                Cell[] cells = s.getRow(i);  
                	  Cell c=cells[4];
                        clusters[i] = c.getContents().trim();
                        
                   }
                } 
            System.out.println();
            return array_unique(clusters);//==============================================unique算法将存储簇信息的数组做去重复操作
            }
    
    
    public static int getClusterNum(String[] a,String clusterName){//=======================================计算每个簇的大小
    	
         int clusterNum=0;      
    	// List<String> list=new LinkedList<String>();
   	   for(int i=1;i<a.length;i++){
   		   if(a[i].contains(clusterName)){
   			   clusterNum++;
   		   }
    }
   	   return clusterNum;
    }
    public static int getBestCluster(double[] k){//===============================================求k-summary值最大的簇
    	double max=0;
    	int mark=0;
    	for(int i=0;i<k.length;i++){
    		if(k[i]>max){
    			max=k[i];
    			mark=i;
    		}
    	}
    	return mark;
    }
}  