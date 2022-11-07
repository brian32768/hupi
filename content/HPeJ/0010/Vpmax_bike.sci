
// Display mode
mode(0);

// Display warning for floating point exception
ieee(1);

//% Maximum cycling speed: Vpmax
//  Junghsen Lieh, Wright State University, Ohio
//  jlieh@cs.wright.edu;       December 23, 2006
//  converted to Scilab format December 30, 2006
// 
m = 60;
den = 1.218;
Cd = 0.35;
Af = 0.35;
grade = 0;
g = 9.81;
fo = 0.013;
f1 = 0.0000005184;
mu = 0.8;
h = 1.05;
ha = 0.9;
w = m*g;
a = 0.7;
b = 0.4;
L = a+b;
eff = 1;
theta = atan(grade/100);
for ii = 1:100
  Pt = 10*ii;
  Power(1,ii) = Pt;
  r1 = ((0.5*den)*Cd)*Af+f1*w;
  r2 = w*(fo+sin(theta));
  r3 = Pt*eff;
  temp = (108*r3+12*sqrt((3*(4*(r2^3)+(27*(r3^2))*r1))/r1))*(r1^2);
  Vpmax(1,ii) = (((temp^(1/3))/(6*r1)-(2*r2)/(temp^(1/3)))*3600)/1000;
end;
plot(Power,Vpmax,"b")
xlabel("Power, Watt")
ylabel("Maximum speed, km/hr")


// !! L.24: string output can be different from Matlab num2str output

title("Cd="+string(Cd)+", Af="+string(Af)+", fo="+string(fo)+", mass="+string(m)+", grade="+string(grade)+"%"+", a="+string(a)+", b="+string(b)+", h="+string(h)+", ha="+string(ha))
set(gca(),"grid",[1,1])
