package Model;

import java.util.HashMap;

public class QueryResult {

private String[] columnName;
private String[][] content;
private int countRow;
public QueryResult(){
}
    public String get(int index, String find){
        String result="";
        if(columnName!=null && index<countRow){
            for(int i=0;i<columnName.length;i++){
                if(columnName[i].equals(find)){
                    result=content[index][i];
                    break;
                }
            }
        }
        return result;
    }
    public Model getModel(){
        Model result= new Model();
        //if(columnName!=null && index<countRow){
            for(int j=0;j<countRow;j++){
                for(int i=0;i<columnName.length;i++){
                    result.display.put("isi["+j+"]"+"["+columnName[i]+"]", content[j][i]);
                    //System.out.println("isi["+j+"]"+"["+columnName[i]+"]"+" = "+content[j][i]);
                }
            }
            result.display.put("isi.count()", countRow);
        //}
        return result;
    }
    public String[] getColumnName() {
        return columnName;
    }
    
    public void setColumnName(String[] columnName) {
        this.columnName = columnName;
    }

    public String[][] getContent() {
        return content;
    }

    public void setContent(String[][] content) {
        this.content = content;
    }

    public int getCountRow() {
        return countRow;
    }

    public void setCountRow(int countRow) {
        this.countRow = countRow;
    }
    public int count(){
        return countRow;        
    }
    public boolean isEmpty(int index){
        if(columnName[index]!=null && index<countRow){
            return false;
        }else return true;
    }

}