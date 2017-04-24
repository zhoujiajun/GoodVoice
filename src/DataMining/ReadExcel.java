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
               //--------------------------------------------------�����Լ�������ǩ�ֿ����ֵ���ά����tag���棨�����ظ���
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
                
                
                
                //============================================���������Ϣ
                
				Scanner cin=new Scanner(System.in);
                System.out.println("����������ı�ǩ��Ŀ��");
                int number=cin.nextInt();
                System.out.println();
                String[] song=new String[number+3];
                double[] freq=new double[20];
                for(int j=0;j<number+3;j++){
            		freq[j]=0;
            	}
                    int j=0;
                	System.out.println("�������������ר�����ƣ�");
                	song[j++]=cin.next();
                	System.out.println("������������ƣ�");
                	song[j++]=cin.next();
                	System.out.println("������������ƣ�");
                	song[j++]=cin.next();                	
                	             	
                	System.out.println("�����������ǩ��");
                	for(int a=3;a<number+3;a++){
                		song[a]=cin.next();
                		
                	}//===============================================================������Ϣ���
                	
                double[] result=new double[u_cluster.length];
                for(int l=0;l<u_cluster.length;l++){//------------------------------���￪ʼ����ÿ���ص�k-summary
                	
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
                     System.out.println("Ŀ�������"+u_cluster[l]+"�ľ���Ϊ"+result[l]);
                }
         
       
    }//--------------------------------------------------------------------------K-summary�������
                System.out.println();
                int ooo=getBestCluster(result);
                System.out.println("��Ŀ��������뵽"+u_cluster[ooo]+"��");
                cin.close();
                return song;
         }
 
    
    
    
    
    
    
    
    
    
    
    public static double frequent1(int i,int rows,String[] song,Sheet s,String u_cluster){//================����ר�����ּ�������һ�����е�Ƶ��
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
    public static double frequent2(int m,String[] tag[],String song){//===============================���������ǩ��Ƶ��
  	   double freq=0;
	   List<String> list=new LinkedList<String>();
	   list.add(song);
	   
	   for(int i=0;i<tag[m].length;i++){//����Ŀ����������������һ������ռ��Ƶ�ʡ�
		   if(list.contains(tag[m][i])){
			   freq++;
			  
		   }
	   }
	
  	 return freq;
  	  
    }
  //====================================================K-summary
    public static double k_summary(double[] freq,int num,int Clusternum){//ClusterNumΪ�صĴ�С
    	double sum=0;
    	for(int i=3;i<num+3;i++){//��������ǩ���е�Ƶ�����
    		freq[i]=1-(freq[i]/Clusternum);
    		sum+=freq[i];
    	}
    	for(int i=0;i<3;i++){//����ר���������Լ�������Ϣ��Ƶ��
    		freq[i]=1-(freq[i]/Clusternum);
    	}
    	double re=0.3*freq[0]+0.05*freq[1]+0.35*freq[2]+0.3*(sum/num);//����Ȩֵ�������е�Ƶ�����
    	                                                              
    	return re;
    }
    public static int splitChar(int m,String info,int p_count,String[] tag[]){//================================================�ָ��ǩ 
    	
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
    public static String[] array_unique(String[] a){//==============================================�����дش���unique�ַ�������
 	   
 	   List<String> list=new LinkedList<String>();
 	   for(int i=1;i<a.length;i++){
 		   if(!list.contains(a[i])){
 			   list.add(a[i]);
 		   }
 	   }
 	   return (String[])list.toArray(new String[list.size()]);
    }
    public static String[] getCluster(String[] clusters,int rows,Sheet s){
    	 //=======================================================================================�õ��洢�ص�����
        if(rows > 0){
            for(int i = 1 ;i < rows ; i++){
                
                Cell[] cells = s.getRow(i);  
                	  Cell c=cells[4];
                        clusters[i] = c.getContents().trim();
                        
                   }
                } 
            System.out.println();
            return array_unique(clusters);//==============================================unique�㷨���洢����Ϣ��������ȥ�ظ�����
            }
    
    
    public static int getClusterNum(String[] a,String clusterName){//=======================================����ÿ���صĴ�С
    	
         int clusterNum=0;      
    	// List<String> list=new LinkedList<String>();
   	   for(int i=1;i<a.length;i++){
   		   if(a[i].contains(clusterName)){
   			   clusterNum++;
   		   }
    }
   	   return clusterNum;
    }
    public static int getBestCluster(double[] k){//===============================================��k-summaryֵ���Ĵ�
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