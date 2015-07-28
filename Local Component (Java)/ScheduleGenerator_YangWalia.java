import javax.imageio.ImageIO;
import java.awt.*;
import java.awt.geom.Rectangle2D;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;
import java.util.Scanner;

class Period {
    public String symbol; //Period One would be "1", Assembly would be "A", Break would be "Br"
    public String time; //Time representation
    public String modifier; //Case statement for color: predefined types (class, special, break)

    public Period(String symbol, String time, String modifier) {
        this.symbol = symbol;
        this.time = time;
        this.modifier = modifier;
    }

    public String getSymbol() {
        return symbol;
    }

    public String getTime() {
        return time;
    }

    public String getModifier() {
        return modifier;
    }
}

class Announcement {
    public String text;
    public String modifier;
    public int characterLength;

    public Announcement(String text, String modifier) {
        this.text = text;
        this.modifier = modifier;
    }

    public String getText() {
        return text;
    }

    public String getModifier() {
        return modifier;
    }
}

class DaySchedule {
    public Period[] periods;
    public Announcement[] announcements;
    public String date;

    public DaySchedule(String date, Period[] periods, Announcement[] announcements) {
        this.date = date;
        this.periods = periods;
        this.announcements = announcements;
    }
}

public class ScheduleGenerator_YangWalia {

    private static final String IMAGE_DESTINATION = "School_Logo.PNG"; 
    private static final String SCHEDULE_API_PATH = "http://WEB_PATH/getschedule.php";
    
    public static void main(String[] args) throws Exception {
        //DaySchedule test = createTestDaySchedule(); - Test image generation without server access
        DaySchedule test = getServerDaySchedule();

        int width = 612, height = 792;

        BufferedImage bufferedImage = createBufferedImage(test, width, height);

        System.out.println("Image created. Attempting to place onto path: " + IMAGE_DESTINATION);
        ImageIO.write(bufferedImage, "JPEG", new File(IMAGE_DESTINATION));
        System.out.println("Image successfully placed on: " + IMAGE_DESTINATION);        
    }
    
    static DaySchedule getServerDaySchedule() {
    
        try {
            URL url = new URL(SCHEDULE_API_PATH);
            Scanner in = new Scanner(url.openStream());
            
            int period_count = Integer.parseInt(in.nextLine());
            int announcement_count = Integer.parseInt(in.nextLine()); 
            
            String date = in.nextLine();
            System.out.println("Data for " + date + " being pulled from: " + SCHEDULE_API_PATH);
            
            Period[] getPeriods = new Period[period_count];

            for (int i = 0; i < period_count; i++) {
                getPeriods[i] = new Period(in.nextLine(), in.nextLine(), in.nextLine());
            }
            
            Announcement[] getAnnouncements = new Announcement[announcement_count];
            
            for (int i = 0; i < announcement_count; i++) {
                getAnnouncements[i] = new Announcement(in.nextLine(), in.nextLine());
            }
            
            System.out.println("Data successfully pulled from: " + SCHEDULE_API_PATH);
  
            return new DaySchedule(date, getPeriods, getAnnouncements);
  
        } catch (Exception e) {
            e.printStackTrace();
        }  
        
        return null;  
    }

    static DaySchedule createTestDaySchedule() {
        String[] period1 = {"1", "8:15-9:05am", "class"};
        String[] period2 = {"2", "9:15-10:05am", "class"};
        String[] period3 = {"Br", "10:05-10:15am", "break"};
        String[] period4 = {"3", "10:20-11:10am", "break"};
        String[] period5 = {"A", "11:20-12:10pm", "special"};
        String[] period6 = {"Lu", "12:10-12:50pm", "break"};
        String[] period7 = {"4", "12:55-1:45pm", "class"};
        String[] period8 = {"5", "1:55-2:45pm", "class"};

        String[] announcement1 = {"Assembly in Main Gymnasium", "special"};
        String[] announcement2 = {"ASB Elections due Midnight on Canvas", "normal"};
        String[] announcement3 = {"Implement a very basic HashMap using the extremely simple hash function", "normal"};

        String[][] tempDouble1 = {period1, period2, period3, period4, period5, period6, period7, period8};
        String[][] tempDouble2 = {announcement1, announcement2, announcement3};

        Period[] tempPeriods = new Period[8];

        for (int i = 0; i < 8; i++) {
            tempPeriods[i] = new Period(tempDouble1[i][0], tempDouble1[i][1], tempDouble1[i][2]);
        }

        Announcement[] tempAnnouncements = new Announcement[3];

        for (int i = 0; i < 3; i++) {
            tempAnnouncements[i] = new Announcement(tempDouble2[i][0], tempDouble2[i][1]);
        }

        //Only thing available
        return new DaySchedule("", tempPeriods, tempAnnouncements);
    }

    static BufferedImage createBufferedImage(DaySchedule daySchedule, final int width, final int height) throws IOException {
        BufferedImage bufferedImage = new BufferedImage(width, height, BufferedImage.TYPE_INT_RGB);
        Graphics2D graphics2d = bufferedImage.createGraphics();

        graphics2d.setColor(Color.black);
        graphics2d.fillRect(0, 0, width, height);

        final String fontName = "Arial";
        graphics2d.setFont(new Font(fontName, Font.BOLD, width / 15));
        FontMetrics fontMetrics = graphics2d.getFontMetrics();

        //Heading
        String message = daySchedule.date;
        int headerWidth = fontMetrics.stringWidth(message);
        int headerHeight = fontMetrics.getAscent();
        final int headerX = (width - headerWidth) / 2;
        final int headerY = height / 10 + headerHeight / 2;
        drawTextWithBackground(message, Color.white, Color.black, headerX, headerY, graphics2d);

        //Schedule
        graphics2d.setFont(new Font(fontName, Font.PLAIN, width / 20));
        int scheduleWidth = (int) (width * 0.6);
        int noOfPeriods = daySchedule.periods.length;
        int spacingGap = scheduleWidth / noOfPeriods;
        int scheduleX = (width - headerWidth) / 3;
        for (int i = 0; i < noOfPeriods; i++) {
            String symbol = " " + daySchedule.periods[i].getSymbol() + " ";
            String modifier = daySchedule.periods[i].getModifier();
            String time = daySchedule.periods[i].getTime();

            int scheduleItemY = height / 8 + headerHeight / 4 + spacingGap * (i + 1);

            if (modifier.equals("Regular Class")) {
                drawTextWithBackground(symbol, Color.white, Color.blue, scheduleX, scheduleItemY, graphics2d);
            } else if (modifier.equals("Assembly/Liturgy")) {
                drawTextWithBackground(symbol, Color.white, Color.pink, scheduleX, scheduleItemY, graphics2d);
            } else if (modifier.equals("Break/Lunch")) {
                drawTextWithBackground(symbol, Color.white, Color.red, scheduleX, scheduleItemY, graphics2d);
            } else {
                drawTextWithBackground(symbol, Color.white, Color.green, scheduleX, scheduleItemY, graphics2d);
            }               

            drawTextWithBackground(time, Color.white, Color.black, scheduleX + fontMetrics.stringWidth("      "), scheduleItemY, graphics2d);
        }

        //Announcements
        graphics2d.setColor(Color.white);
        graphics2d.fillRect(0, height / 6 + scheduleWidth + 20, width, height);

        BufferedImage bellImage = ImageIO.read(new File("BellIcon.jpg"));
        graphics2d.drawImage(bellImage, 0, height / 6 + scheduleWidth + 40, null);

        graphics2d.setFont(new Font(fontName, Font.BOLD, width / 20));
        drawTextWithBackground("Announcements", Color.black, Color.white, 0, height / 6 + scheduleWidth + 20, graphics2d);

        graphics2d.setFont(new Font(fontName, Font.PLAIN, width / 30));

        fontMetrics = graphics2d.getFontMetrics();
        int announceItemY = height / 5 + scheduleWidth + headerHeight;

        for (int j = 0; j < daySchedule.announcements.length; j++) {


            String announceText = daySchedule.announcements[j].getText();
            String announceModifier = daySchedule.announcements[j].getModifier();

            ArrayList<String> announceTextSegments = new ArrayList<String>();

            for (String element : announceText.split("\\s")) {
                announceTextSegments.add(element);
            }

            String segment = "";


            for (int i = 0; i < announceTextSegments.size(); i++) {
                int segmentWidth = fontMetrics.stringWidth(segment + " " + announceTextSegments.get(i));
                if (width - scheduleX - 100 < segmentWidth) {
                    if (announceModifier.equals("Assembly/Liturgy")) {
                        drawTextWithBackground(segment, Color.white, Color.pink, scheduleX + 100, announceItemY, graphics2d);
                    } else if (announceModifier.equals("Other")) {
                        drawTextWithBackground(segment, Color.white, Color.green, scheduleX + 100, announceItemY, graphics2d);
                    } else {
                        drawTextWithBackground(segment, Color.black, Color.white, scheduleX + 100, announceItemY, graphics2d);                    
                    }
                    announceItemY += width / 25;
                    segment = " " + announceTextSegments.get(i);
                } else {
                    segment += " " + announceTextSegments.get(i);
                }
            }
            if (announceModifier.equals("Assembly/Liturgy")) {
                drawTextWithBackground(segment, Color.white, Color.pink, scheduleX + 100, announceItemY, graphics2d);
            } else if (announceModifier.equals("Other")) {
                drawTextWithBackground(segment, Color.white, Color.green, scheduleX + 100, announceItemY, graphics2d);
            } else {
                drawTextWithBackground(segment, Color.black, Color.white, scheduleX + 100, announceItemY, graphics2d);                    
            }

            announceItemY += width / 15;
        }

        return bufferedImage;
    }

    static void drawTextWithBackground(String message, Color textColor, Color bgColor, int x, int y, Graphics2D graphics2D) {
        FontMetrics fm = graphics2D.getFontMetrics();
        Rectangle2D rect = fm.getStringBounds(message, graphics2D);

        graphics2D.setColor(bgColor);
        graphics2D.fillRoundRect(x,
                y - fm.getAscent(),
                (int) rect.getWidth(),
                (int) rect.getHeight(),
                10, 10);

        graphics2D.setColor(textColor);
        graphics2D.drawString(message, x, y);
    }
}
