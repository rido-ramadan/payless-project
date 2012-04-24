package Model;

import java.util.HashMap;

public class Model {

    public HashMap<String, Object> display = new HashMap<String, Object>();
    public Model(){

    }

    public HashMap<String, Object> getDisplay() {
        return display;
    }

    public void setDisplay(HashMap<String, Object> display) {
        this.display = display;
    }
    
}