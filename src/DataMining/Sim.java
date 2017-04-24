/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DataMining;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;

/**
 *
 * @author LH
 */
public class Sim {
    
    public static void main(String[] args) throws IOException{
        ArrayList<String> texts = new ArrayList<String>();
        texts.add("香云纱其实是一种经过特殊处理的丝绸，它从明代永乐年间开始生产，二十世纪二三十年代达到顶峰，被当时的上海滩富豪视为高贵的服饰。在那个时代的老电影中，你不难发现它的身影。但是在上个世纪的五十年代以后，它作为消费“奢侈品”开始逐渐销声匿迹，在历史的长河中渐渐被人遗忘，这项古老的生产工艺也几近失传。直到2008年国家把这种独特的纱线染整技术确认为国家级的非物质文化遗产并且对之加以推广，这种古老的面料才慢慢地为重新回到大家的视线。");
        texts.add("香云纱是目前纺织品中极少数的使用纯植物染料染色的桑蚕丝绸织物。它是一种用广东特有的植物薯莨的汁水浸染桑蚕丝织物，再用顺德伦教地区特有的富含多种矿物质的河涌淤泥覆盖，经反复日晒加工而成的一种昂贵的绿色环保纱绸织品。经过处理后的织物厚度增加约30%，重量增加约40%。由于受生产制造特殊性的影响（手工，气候，薯莨植被等），产量很少，更显得珍稀。因为附着了矿物塘泥，香云纱穿上身后感觉凉爽，遇水快干，且不容易抽丝和起皱。同时，由于薯莨本身就是一种中药，有清热化瘀的功效，还有防霉、除菌、除臭等功效，所以用香云纱做成的衣服也具有相同的“医用”效果。由于受天气等自然影响和手工制作的局限，所以面料上会有少量的黑斑、红斑及白痕，属正常现象，这也正是区别于赝品的特殊标识。");
        int n = 100;
        double s = getSimilarity(texts,n);
        System.out.println(s);
        
    }
    
    public static double getSimilarity(ArrayList<String> texts,int n) throws IOException{
        HashMap<String, ArrayList<String>> keyWord = getKeyWord(texts,n);
        MaxSim ms = new MaxSim();
        double similarity = ms.getSimilarDegree(keyWord);
        return similarity;
    }
    
    public static HashMap<String, HashMap<String, Float>> getTfIdf(ArrayList<String> texts) throws IOException{
//        ArrayList<String> texts = new ArrayList<String>();
//        texts.add("今天我 寒夜里看雪飘过");
//        texts.add("风雨里追赶 雾里分不清影踪");
        ReadFiles rf = new ReadFiles(texts);
        
        HashMap<String,HashMap<String, Float>> all_tf = rf.tfAllFiles();
//        System.out.println();
        HashMap<String, Float> idfs = rf.idf(all_tf);
//        System.out.println();
        
        HashMap<String, HashMap<String, Float>> tfIdf = rf.tf_idf(all_tf, idfs);
        
        return tfIdf;
    }
    
    public static HashMap<String, ArrayList<String>> getKeyWord(ArrayList<String> texts,int n) throws IOException{
        HashMap<String, HashMap<String, Float>> tfIdf = getTfIdf(texts);
        HashMap<String, ArrayList<String>> keyWords = new HashMap<String, ArrayList<String>>();
        for(String key:tfIdf.keySet()){
            HashMap<String,Float> words = tfIdf.get(key);
            words = sortByComparator(words);
            ArrayList<String> kword = new ArrayList<String>();
            int sum = words.size();
            if(sum<n){
                for(String key1:words.keySet()){
                    kword.add(key1);
                }
            }
            else{
                int i =0;
                for(String key1:words.keySet()){
                    if(i>=n){
                        break;
                    }
                    kword.add(key1);
                    i++;
                }
            }
            keyWords.put(key, kword);
        }
        return keyWords;
    }
    
    private static HashMap sortByComparator(HashMap unsortMap) {
 
        List list = new LinkedList(unsortMap.entrySet());
 
        //sort list based on comparator
        Collections.sort(list, new Comparator() 
        {
            public int compare(Object o1, Object o2) 
            {
               return ((Comparable) ((Map.Entry) (o2)).getValue()).compareTo(((Map.Entry) (o1)).getValue());
            }
        });
 
        //put sorted list into map again
        HashMap sortedMap = new LinkedHashMap();
        for (Iterator it = list.iterator(); it.hasNext();) {
            Map.Entry entry = (Map.Entry)it.next();
            sortedMap.put(entry.getKey(), entry.getValue());
        }
        return sortedMap;
    }
}
