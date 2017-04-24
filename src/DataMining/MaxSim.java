/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DataMining;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;


/**
 *
 * @author LH
 */
public class MaxSim {
    public static double getSimilarDegree(HashMap<String, ArrayList<String>> keyWords) 
     { 
        //创建向量空间模型，使用map实现，主键为词项，值为长度为2的数组，存放着对应词项在字符串中的出现次数 
         Map<String, int[]> vectorSpace = new HashMap<String, int[]>(); 
         int[] itemCountArray = null;//为了避免频繁产生局部变量，所 以将itemCountArray声明在此 
         String s[] = new String[2];
         int i = 0;
         for(String key:keyWords.keySet()){
             s[i] = key;
             i++;
         }
         
         ArrayList<String> words = keyWords.get(s[0]);
             
        for(String word:words){
//           System.out.println(word);
           if(vectorSpace.containsKey(word)) 
               ++(vectorSpace.get(word)[0]); 
           else 
           { 
               itemCountArray = new int[2]; 
               itemCountArray[0] = 1; 
               itemCountArray[1] = 0; 
               vectorSpace.put(word, itemCountArray); 
           } 
        }
        
        words = keyWords.get(s[1]);
             
        for(String word:words){
//           System.out.println(word);
           if(vectorSpace.containsKey(word)) 
               ++(vectorSpace.get(word)[1]); 
           else 
           { 
               itemCountArray = new int[2]; 
               itemCountArray[0] = 0; 
               itemCountArray[1] = 1; 
               vectorSpace.put(word, itemCountArray); 
           } 
        }
        
        
//         System.out.println(vectorSpace);
         
//         String strArray[] =  keyWords.valu
//         for(int i=0; i<strArray.length; ++i) 
//         { 
//             if(vectorSpace.containsKey(strArray[i])) 
//                 ++(vectorSpace.get(strArray[i])[0]); 
//             else 
//             { 
//                 itemCountArray = new int[2]; 
//                 itemCountArray[0] = 1; 
//                 itemCountArray[1] = 0; 
//                 vectorSpace.put(strArray[i], itemCountArray); 
//             } 
//         } 
//          
//         strArray = str2.split(" "); 
//         for(int i=0; i<strArray.length; ++i) 
//         { 
//             if(vectorSpace.containsKey(strArray[i])) 
//                 ++(vectorSpace.get(strArray[i])[1]); 
//             else 
//             { 
//                 itemCountArray = new int[2]; 
//                 itemCountArray[0] = 0; 
//                 itemCountArray[1] = 1; 
//                 vectorSpace.put(strArray[i], itemCountArray); 
//             } 
//         } 
          
         //计算相似度 
         double vector1Modulo = 0.00;//向量1的模 
         double vector2Modulo = 0.00;//向量2的模 
         double vectorProduct = 0.00; //向量积 
         Iterator iter = vectorSpace.entrySet().iterator(); 
          
         while(iter.hasNext()) 
         { 
             Map.Entry entry = (Map.Entry)iter.next(); 
             itemCountArray = (int[])entry.getValue(); 
              
             vector1Modulo += itemCountArray[0]*itemCountArray[0]; 
             vector2Modulo += itemCountArray[1]*itemCountArray[1]; 
              
             vectorProduct += itemCountArray[0]*itemCountArray[1]; 
         } 
          
         vector1Modulo = Math.sqrt(vector1Modulo); 
         vector2Modulo = Math.sqrt(vector2Modulo); 
          
         //返回相似度  www.2cto.com
        return (vectorProduct/(vector1Modulo*vector2Modulo)); 
     } 
    
    public static void main(String[] args) throws IOException{
//        System.out.println(getSimilarDegree("we are beautiful boys", "we are beautiful girls"));
        ArrayList<String> texts = new ArrayList<String>();
       // texts.add("我们是好人");
        //texts.add("我们是坏人");
          texts.add("今天我 寒夜里看雪飘过");
          texts.add("风雨里追赶 雾里分不清影踪");
        Sim similarity = new Sim();
        int n = 100;
        HashMap<String, ArrayList<String>> key = similarity.getKeyWord(texts,n);
        for(ArrayList<String> k:key.values()){
            System.out.println(k);
        }
        System.out.println(getSimilarDegree(key));
    }
}
