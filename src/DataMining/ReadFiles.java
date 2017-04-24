/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DataMining;

/**
 *
 * @author LH
 */
//package tfidf;

import java.io.*;
import java.util.*;
import org.wltea.analyzer.core.IKSegmenter;
import org.wltea.analyzer.core.Lexeme;

import org.wltea.analyzer.lucene.IKAnalyzer;


public class ReadFiles {

    /**
     * @param args
     */    
    private static ArrayList<String> FileList = new ArrayList<String>(); // the list of file

    //get list of file for the directory, including sub-directory of it
    
    public ReadFiles(ArrayList<String> texts){
        FileList = texts;
    }
    public static List<String> readDirs(String filepath) throws FileNotFoundException, IOException
    {
        try
        {
            File file = new File(filepath);
            if(!file.isDirectory())
            {
                System.out.println("输入的[]");
                System.out.println("filepath:" + file.getAbsolutePath());
            }
            else
            {
                String[] flist = file.list();
                for(int i = 0; i < flist.length; i++)
                {
                    File newfile = new File(filepath + "\\" + flist[i]);
                    if(!newfile.isDirectory())
                    {
                        FileList.add(newfile.getAbsolutePath());
                    }
                    else if(newfile.isDirectory()) //if file is a directory, call ReadDirs
                    {
                        readDirs(filepath + "\\" + flist[i]);
                    }                    
                }
            }
        }catch(FileNotFoundException e)
        {
            System.out.println(e.getMessage());
        }
        return FileList;
    }
    
    //read file
    public static String readFile(String file) throws FileNotFoundException, IOException
    {
        StringBuffer strSb = new StringBuffer(); //String is constant， StringBuffer can be changed.
        InputStreamReader inStrR = new InputStreamReader(new FileInputStream(file), "gbk"); //byte streams to character streams
        BufferedReader br = new BufferedReader(inStrR); 
        String line = br.readLine();
        while(line != null){
            strSb.append(line).append("\r\n");
            line = br.readLine();    
        }
        
        return strSb.toString();
    }
    
    //word segmentation
    public static ArrayList<String> cutWords(String file) throws IOException{
        
        ArrayList<String> words = new ArrayList<String>();
//        String text = ReadFiles.readFile(file);
//        IKAnalyzer analyzer = new IKAnalyzer();
//        words = analyzer.split(text);
        IKSegmenter ikSegmenter = new IKSegmenter(new StringReader(file), true);
        Lexeme lexeme;
        while ((lexeme = ikSegmenter.next()) != null) {
            if(lexeme.getLexemeText().length()>1){
//                if(wordsFren.containsKey(lexeme.getLexemeText())){
//                    wordsFren.put(lexeme.getLexemeText(),wordsFren.get(lexeme.getLexemeText())+1);
//                }else {
//                    wordsFren.put(lexeme.getLexemeText(),1);
//                }
                words.add(lexeme.getLexemeText());
            }
           
        }
        
        
        return words;
    }
    
    //term frequency in a file, times for each word
    public static HashMap<String, Integer> normalTF(ArrayList<String> cutwords){
        HashMap<String, Integer> resTF = new HashMap<String, Integer>();
        
        for(String word : cutwords){
            if(resTF.get(word) == null){
                resTF.put(word, 1);
//                System.out.println(word);
            }
            else{
                resTF.put(word, resTF.get(word) + 1);
//                System.out.println(word.toString());
            }
        }
        return resTF;
    }
    
    //term frequency in a file, frequency of each word
    public static HashMap<String, Float> tf(ArrayList<String> cutwords){
        HashMap<String, Float> resTF = new HashMap<String, Float>();
        
        int wordLen = cutwords.size();
        HashMap<String, Integer> intTF = ReadFiles.normalTF(cutwords); 
        
        Iterator iter = intTF.entrySet().iterator(); //iterator for that get from TF
        while(iter.hasNext()){
            Map.Entry entry = (Map.Entry)iter.next();
            resTF.put(entry.getKey().toString(), Float.parseFloat(entry.getValue().toString()) / wordLen);
//            System.out.println(entry.getKey().toString() + " = "+  Float.parseFloat(entry.getValue().toString()) / wordLen);
        }
        return resTF;
    } 
    
    //tf times for file
    public static HashMap<String, HashMap<String, Integer>> normalTFAllFiles(String dirc) throws IOException{
        HashMap<String, HashMap<String, Integer>> allNormalTF = new HashMap<String, HashMap<String,Integer>>();
        
        List<String> filelist = ReadFiles.readDirs(dirc);
        for(String file : filelist){
            HashMap<String, Integer> dict = new HashMap<String, Integer>();
            ArrayList<String> cutwords = ReadFiles.cutWords(file); //get cut word for one file
            
            dict = ReadFiles.normalTF(cutwords);
            allNormalTF.put(file, dict);
        }    
        return allNormalTF;
    }
    
    //tf for all file
    public static HashMap<String,HashMap<String, Float>> tfAllFiles() throws IOException{
        HashMap<String, HashMap<String, Float>> allTF = new HashMap<String, HashMap<String, Float>>();
//        List<String> filelist = ReadFiles.readDirs(dirc);
        
        for(String file : FileList){
            HashMap<String, Float> dict = new HashMap<String, Float>();
            ArrayList<String> cutwords = cutWords(file); //get cut words for one file
            
            dict = tf(cutwords);
            allTF.put(file, dict);
        }
        return allTF;
    }
    public static HashMap<String, Float> idf(HashMap<String,HashMap<String, Float>> all_tf){
        HashMap<String, Float> resIdf = new HashMap<String, Float>();
        HashMap<String, Integer> dict = new HashMap<String, Integer>();
        int docNum = FileList.size();
        
        for(int i = 0; i < docNum; i++){
            HashMap<String, Float> temp = all_tf.get(FileList.get(i));
            Iterator iter = temp.entrySet().iterator();
            while(iter.hasNext()){
                Map.Entry entry = (Map.Entry)iter.next();
                String word = entry.getKey().toString();
                if(dict.get(word) == null){
                    dict.put(word, 1);
                }else {
                    dict.put(word, dict.get(word) + 1);
                }
            }
        }
//        System.out.println("IDF for every word is:");
        Iterator iter_dict = dict.entrySet().iterator();
        while(iter_dict.hasNext()){
            Map.Entry entry = (Map.Entry)iter_dict.next();
            float value = (float)Math.log(docNum / Float.parseFloat(entry.getValue().toString()));
            resIdf.put(entry.getKey().toString(), value);
//            System.out.println(entry.getKey().toString() + " = " + value);
        }
        return resIdf;
    }
    public static HashMap<String, HashMap<String, Float>> tf_idf(HashMap<String,HashMap<String, Float>> all_tf,HashMap<String, Float> idfs){
        HashMap<String, HashMap<String, Float>> resTfIdf = new HashMap<String, HashMap<String, Float>>();
            
        int docNum = FileList.size();
        for(int i = 0; i < docNum; i++){
            String filepath = FileList.get(i);
            HashMap<String, Float> tfidf = new HashMap<String, Float>();
            HashMap<String, Float> temp = all_tf.get(filepath);
            Iterator iter = temp.entrySet().iterator();
            while(iter.hasNext()){
                Map.Entry entry = (Map.Entry)iter.next();
                String word = entry.getKey().toString();
                Float value = (float)Float.parseFloat(entry.getValue().toString()) * idfs.get(word); 
                tfidf.put(word, value);
            }
            resTfIdf.put(filepath, tfidf);
        }
//        System.out.println("TF-IDF for Every file is :");
//        System.out.println(resTfIdf);
//        DisTfIdf(resTfIdf);
        return resTfIdf;
    }
    public static void DisTfIdf(HashMap<String, HashMap<String, Float>> tfidf){
        Iterator iter1 = tfidf.entrySet().iterator();
        while(iter1.hasNext()){
            Map.Entry entrys = (Map.Entry)iter1.next();
//            System.out.println("FileName: " + entrys.getKey().toString());
//            System.out.print("{");
            HashMap<String, Float> temp = (HashMap<String, Float>) entrys.getValue();
            Iterator iter2 = temp.entrySet().iterator();
            while(iter2.hasNext()){
                Map.Entry entry = (Map.Entry)iter2.next(); 
//                System.out.print(entry.getKey().toString() + " = " + entry.getValue().toString() + ", ");
            }
//            System.out.println("}");
        }
        
    }
    public static void main(String[] args) throws IOException {
        // TODO Auto-generated method stub
//        String file = "D:/testfiles";
//
        ArrayList<String> texts = new ArrayList<String>();
        texts.add("今天我 寒夜里看雪飘过");
        texts.add("风雨里追赶 雾里分不清影踪");
        ReadFiles rf = new ReadFiles(texts);
        
        HashMap<String,HashMap<String, Float>> all_tf = rf.tfAllFiles();
        System.out.println();
        HashMap<String, Float> idfs = rf.idf(all_tf);
        System.out.println();
        
        HashMap<String, HashMap<String, Float>> tfIdf = rf.tf_idf(all_tf, idfs);

//    ArrayList<String> word = getTextDef("今天天气不错，我吃得很好，你在哪里，我在哪里");
//    System.out.println(word);

     
       
    }
    
    public static ArrayList<String> getTextDef(String text) throws IOException {
        Map<String, Integer> wordsFren=new HashMap<String, Integer>();
        ArrayList<String> words = new ArrayList<String>();
        IKSegmenter ikSegmenter = new IKSegmenter(new StringReader(text), true);
        Lexeme lexeme;
        while ((lexeme = ikSegmenter.next()) != null) {
            if(lexeme.getLexemeText().length()>1){
//                if(wordsFren.containsKey(lexeme.getLexemeText())){
//                    wordsFren.put(lexeme.getLexemeText(),wordsFren.get(lexeme.getLexemeText())+1);
//                }else {
//                    wordsFren.put(lexeme.getLexemeText(),1);
//                }
                words.add(lexeme.getLexemeText());
            }
           
        }
        
        return words;
    }

}