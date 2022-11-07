%% Maximum cycling speed: Vpmax
%  Junghsen Lieh, Wright State University, Ohio
%  jlieh@cs.wright.edu;       December 23, 2006
%
m  = 60;       den = 1.218;     Cd = 0.35;      Af = 0.35;
grade = 0;     g   = 9.81;      fo = 0.013;     f1 = 0.0000005184;
mu = 0.8;      h   = 1.05;      ha = 0.9;       w  = m*g;
a  = 0.7;      b   = 0.4;       L  = a + b;     eff = 1.0;
theta = atan(grade/100);
for ii = 1:100;
  Pt = 10*ii;
  Power(ii) = Pt;
  r1 = 0.5*den*Cd*Af + f1*w;
  r2 = w*(fo + sin(theta));
  r3 = Pt*eff;
  temp = ( 108*r3 + 12*sqrt( 3*(4*r2^3 + 27*r3^2*r1)/r1 ) )*r1^2;
  Vpmax(ii) = ( temp^(1/3)/(6*r1) - 2*r2/(temp)^(1/3) )*3600/1000;
end
plot(Power,Vpmax,'b')
xlabel('Power, Watt')
ylabel('Maximum speed, km/h')
title(['Cd=',num2str(Cd), ', Af=',num2str(Af), ', fo=',num2str(fo), ...
       ', mass=',num2str(m), ', grade=',num2str(grade),'%', ...
       ', a=',num2str(a),', b=',num2str(b), ', h=',num2str(h),', ha=',num2str(ha)])
grid on

  
