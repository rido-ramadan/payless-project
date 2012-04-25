package Model;

import java.util.HashMap;

public class Model {

    public HashMap<String, Object> display = new HashMap<String, Object>();
    public Model(){

    }
    public String get(int id, String content){
        return (String) display.get("isi["+id+"]"+"["+content+"]");
    }
    public void put(int id, String column, String content){
        display.put("isi["+id+"]"+"["+column+"]", content);
    }
    public void putObject(int id, String column, Model content){
        display.put("isi["+id+"]"+"["+column+"]", content);
//        for(int i=0;i<(Integer)content.display.get("isi.count()");i++){
//            display.put("isi["+id+"]"+"["+column+"]", content);
//        }
    }
    public int count(){
        return (Integer)display.get("isi.count()");
    }
    public HashMap<String, Object> getDisplay() {
        return display;
    }

    public void setDisplay(HashMap<String, Object> display) {
        this.display = display;
    }
    
}