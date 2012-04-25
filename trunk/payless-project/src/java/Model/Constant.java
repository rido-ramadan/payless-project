/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

import java.lang.String;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

/**
 *
 * @author masphei
 */
public class Constant {
    public static String getDateTime() {
        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Date date = new Date();
        return dateFormat.format(date);
    }
    public static String md5(String s) {
        try {
            MessageDigest m = MessageDigest.getInstance("MD5");
            m.update(s.getBytes(), 0, s.length());
            BigInteger i = new BigInteger(1,m.digest());
            return String.format("%1$032x", i);         
        } catch (NoSuchAlgorithmException e) {
            System.out.println("ex : "+e);
        }
        return null;
    }
    public static void inputTagsInLastKonten(String input_tags){
            String input = input_tags;
            ArrayList<String> tag = new ArrayList<String>();
            if(input==null || input.equals("")) tag.add("uncategorized");
            else{
                String[] delimit = input.split(",");
                for(int i=0;i<delimit.length;i++){
                //foreach ($input as $value) {
                    String value = delimit[i].replace("\"", "");
                    value = value.replace("'", "");
                    String white = value.replace(" ", "");
                    if(!white.equals("")){
                        String[] pos = value.split(" ");
                        //$value = explode(' ', $value);
                        String one_tag="";
                        for(int j=0;j<pos.length;j++){
                            if(!pos[j].equals("")){
                                one_tag+=pos[j];
                                if((j+1)!=pos.length) 
                                    one_tag=one_tag+" ";
                            }
                        }
                        System.out.print("onetag="+one_tag);
                        //echo 'satu tag='.$one_tag.';<br>';
                        tag.add(one_tag);
                        //array_push($tag, $one_tag);
                    }
                    //if(!empty($value))
                    //echo $value .";<br>";
                    System.out.println("value="+value);
                }            
            }
            if(tag.size()>0){
                String query="select max(ID_KONTEN) as max from konten";                
                QueryResult tes = MySQLConnect.query(query);
                //$tes = $this->_model->query($query);
                String id_konten = tes.get(0, "max");
                //$id_konten= $tes[0]['max'];
                for(int i=0;i<tag.size();i++){
                     query="select * from tag where NAMA_TAG=\""+tag.get(i) +"\"";
                     QueryResult QR=MySQLConnect.query(query);
                     if(QR.count()>0){ // sudah ada
                         System.out.println("tag i ="+tag.get(i));
                         //echo $tag[$i];
                         //echo count($query);
                         //echo $query[0]['ID_TAG'];
                         
                           String insert = "insert into konten_tag (ID_KONTEN, ID_TAG) values "
                                   + "("+id_konten+", "+QR.get(0, "ID_TAG")+" "
                                   + ")";
                            if(MySQLConnect.sQuery(insert)){
                                System.out.println("berhasil");
                            }
                     }else{ // tag belum ada
                            String insert = "insert into tag (NAMA_TAG) values (\""+tag.get(i) +"\")";
                            if(MySQLConnect.sQuery(insert)){
                                System.out.println("berhasil");
                            }
                            
                            query="select max(ID_TAG) as max from tag";
                            QueryResult max = MySQLConnect.query(query);
                            String id_tag= max.get(0, "max");
                            
                            insert = "insert into konten_tag (ID_KONTEN, ID_TAG) "
                                    + "values ("+id_konten+", "+id_tag+")";
                            if(MySQLConnect.sQuery(insert)){
                                System.out.println("berhasil");
                            }                         
                     }
                }   
            }
        }
}
