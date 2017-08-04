import cv2
import time
import sys

def diffImg(t0,t1, t2):
    d1 = cv2.absdiff(t2,t1)
    d2 = cv2.absdiff(t1,t0)
    return cv2.bitwise_and(d1, d2)

cam = cv2.VideoCapture(int(sys.argv[1]))

(grabbed, frame) = cam.read()

if not grabbed:
    print('error')

time.sleep(3)

t_minus = cv2.cvtColor(cam.read()[1], cv2.COLOR_RGB2GRAY)
t = cv2.cvtColor(cam.read()[1], cv2.COLOR_RGB2GRAY)
t_plus = cv2.cvtColor(cam.read()[1], cv2.COLOR_RGB2GRAY)

while True:


    diff =  diffImg(t_minus, t, t_plus)
    count = 0
    for x in diff:
        for y in x:
            count += y

    if count >= 300000:
        print('movement')
        cv2.imwrite('/var/www/html/' + str(time.time()) + '-cam'  + str(sys.argv[1]) +  '-test.png', cam.read()[1])
        cv2.imwrite('/var/www/html/last.png', diff)
        file = open('/var/www/html/security/cam' + str( sys.argv[1] ) , "w")
        file.write(str( time.time() ))
        file.close()


    t_minus = t
    
    t = t_plus
    
    t_plus = cv2.cvtColor(cam.read()[1], cv2.COLOR_RGB2GRAY)
    
    key = cv2.waitKey(1)
    if key == 27:
        cv2.destroyWindow(winName)
        break
    time.sleep(1)
    
print('bye')
