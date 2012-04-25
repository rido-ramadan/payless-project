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
import java.util.logging.Level;
import java.util.logging.Logger;

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

    public static int getMaxLike(ArrayList<Content> test){
        int max = -9999;
        int id=0;
        for(int i=0;i<test.size();i++){
            if(max<test.get(i).getLike()){
                max = test.get(i).getLike();
                id= i;
            }
            
        }
        return id;
    }
    public static int getMaxComment(ArrayList<Content> test){
        int max = -9999;
        int id=0;
        for(int i=0;i<test.size();i++){
            if(max<test.get(i).getKomentar().length){
                max = test.get(i).getKomentar().length;
                id= i;
            }
            
        }
        return id;
    }
    
    
    public static ArrayList<Content> getContent(User user) {
        ArrayList<Content> result= new ArrayList<Content>();
        try {
            MySQLConnect conn = new MySQLConnect();
            conn.connect();
            QueryResult konten = MySQLConnect.query(conn, "select * from konten natural join user");
            for(int i=0;i<konten.count();i++){
                Content result2= new Content();
                result2.setJudul(konten.get(i, "JUDUL"));
                result2.setLink(konten.get(i, "LINK"));
                result2.setDeskripsi(konten.get(i, "DESKRIPSI"));
                result2.setUsername(konten.get(i, "USERNAME"));
                result2.setPassword(konten.get(i, "PASSWORD"));
                result2.setNama(konten.get(i, "NAMA"));
                result2.setTgl_lahir(konten.get(i, "TGL_LAHIR"));
                result2.setEmail(konten.get(i, "EMAIL"));
                result2.setAvatar(konten.get(i, "AVATAR"));
                result2.setGender(konten.get(i, "GENDER"));
                result2.setStatus(konten.get(i, "STATUS"));
                result2.setId_user(konten.get(i, "ID_USER"));
                result2.setId_konten(konten.get(i, "ID_KONTEN"));
                result2.setId_type(konten.get(i, "ID_TYPE"));
                result2.setWaktu(konten.get(i, "WAKTU"));
                result2.setAbout_me(konten.get(i, "ABOUT_ME"));            
                result.add(result2);
            }
            if(result.size()>0){
                for(int i=0;i<result.size();i++){
                    int sum_like = 0;
                    int sum_dislike = 0;
                    //like/dislike
                    QueryResult konten_like = MySQLConnect.query(conn, "select * from like_dislike where ID_KONTEN="+result.get(i).getId_konten() +"");
                    for(int j=0;j<konten_like.count();j++){
                        if(konten_like.get(j, "STATUS").equals("LIKE")) sum_like+=1;
                        if(konten_like.get(j, "STATUS").equals("DISLIKE")) sum_dislike+=1;
                    }
                    //echo "dislike=".$sum_dislike."<br>";
                    //echo "dislike=".$sum_dislike."<br>";

                    //user like
                    if(user!=null){
                        QueryResult user_like = MySQLConnect.query(conn, "select * from like_dislike where ID_KONTEN="+konten.get(i, "ID_KONTEN") +" AND ID_USER="+user.ID_User+"");
    //                    System.out.println("user like="+user_like.count());
    //                    System.out.println("id user="+user.ID_User);
    //                    System.out.println("id konten="+konten.get(i, "ID_KONTEN") );
                        if(user_like.count()>0){
                        //echo 'asd';
                            //konten.get(i, "STATUS_USER") = 
                            //Model bean = new Model();
    //                        bean.display.put("konten", bean)
    //                        $konten[$i]['STATUS_USER']=$user_like[0]['STATUS'];
                            result.get(i).setStatus_user(user_like.get(0, "STATUS"));
                            //result.put(i, "STATUS_USER", user_like.get(0, "STATUS"));
                        }
                    }else System.out.println("user null");
    //                //komentar
                    QueryResult komen = MySQLConnect.query(conn, "select * from komentar where ID_KONTEN="+result.get(i).getId_konten());
                    String[] idUserKomen = new String[komen.count()];
                    String[] contentUserKomen = new String[komen.count()];
                    String[] waktuUserKomen = new String[komen.count()];
                    for(int j=0;j<komen.count();j++){
                        idUserKomen[j] = komen.get(j, "ID_USER");
                        contentUserKomen[j] = komen.get(j, "KOMENTAR");
                        waktuUserKomen[j] = komen.get(j, "wAKTU");                    
                    }
                    result.get(i).setKomentar(contentUserKomen);
                    result.get(i).setId_user_komentar(idUserKomen);
                    result.get(i).setWaktu_komentar(waktuUserKomen);
    //                result.putObject(i, "KOMENTAR", komen.getModel());
    //                result.put(i, "KOMENTAR", ""+(sum_like-sum_dislike));
    //                $konten[$i]['KOMENTAR'] = $komen;
    //
                    result.get(i).setLike(sum_like-sum_dislike); 
    //                $konten[$i]['LIKE'] = $sum_like-$sum_dislike;
    //                // tag
                    
                    QueryResult tag = MySQLConnect.query(conn, "select * from konten_tag natural join tag where konten_tag.ID_KONTEN="+result.get(i).getId_konten());
                    String[] tags = new String[tag.count()];
                    for(int j=0;j<tag.count();j++){
                        tags[j] = tag.get(j, "NAMA_TAG");
                    }
                    result.get(i).setTag(tags);
    //                result.putObject(i, "TAG", tag.getModel());
    //                $konten[$i]['TAG'] = $tag;

                }
    //            $result = $konten;
            }
        } catch (Exception ex) {
            Logger.getLogger(Constant.class.getName()).log(Level.SEVERE, null, ex);
        }
            return result;
    }
    
}
