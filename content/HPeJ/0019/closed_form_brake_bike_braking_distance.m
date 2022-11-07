%% closed_form_brake_bike_sample_brake_distance.m
% Prof. Junghsen Lieh, Wright State University, Ohio - USA
% junghsen.lieh@wright.edu, December 21, 2012

clf, clear all;
m = 60;
den = 1.218;
Cd = 0.30;
Af = 0.40;
g = 9.81;
fo = 0.0136;
f1 = 0.0000005184;
mu = 0.8;
h = 0.4;
ha = 0.45;
W = m*g;
La = 1.0;
Lb = 0.40;
L = La + Lb;
grade = 0;
theta = atan(grade/100);
fo = fo*cos(theta);
f1 = f1*cos(theta); % correction for grade

% Full Brakes
s2b1 = m; s1(1) = s2b1;
s2b2 = W*(mu*cos(theta) + fo + sin(theta)); s2(1) = s2b2;
s2b3 = (den/2)*Cd*Af + f1*W; s3(1) = s2b3;

% Front Brake Only
sfb1 = m*(1 - mu*h/L); s1(2) = sfb1;
sfb2 = W*(mu*(Lb/L*cos(theta)-h/L*sin(theta))+fo+sin(theta)); s2(2) = sfb2;
sfb3 = (den/2)*(1 - mu*ha/L)*Cd*Af + f1*W; s3(2) = sfb3;

% Rear Brake Only
srb1 = m*(1 + mu*h/L); s1(3) = srb1;
srb2 = W*(mu*(La/L*cos(theta)+h/L*sin(theta))+fo+sin(theta)); s2(3) = srb2;
srb3 = (den/2)*(1 + mu*ha/L)*Cd*Af + f1*W; s3(3) = srb3;

% Closed-form Solution
kmhr = 60; % Initial speed, km/hr
vo = kmhr*1000/3600; % Initial speed, m/s
dv = -0.02; npt = floor(abs((vo-0)/dv));
to = 0; tf = 20; dt = tf/npt;
for jj = 1:3
c1 = atan(sqrt(s3(jj)/s2(jj))*vo);
c2 = sqrt(s2(jj)*s3(jj))/s1(jj);
ts2bT = s1(jj)/sqrt(s2(jj)*s3(jj))*atan(sqrt(s3(jj)/s2(jj))*vo);
ts(jj) = ts2bT; % Stop time, sec

% Velocity v(t), m/s
v = vo;
ii = 0; t = 0;
while t < ts(jj)
ii = ii + 1;
t = to + (ii-1)*dt;
v = sqrt(s2(jj)/s3(jj))*tan(c1-c2*t); % Velocity at time t, sec
dis = s1(jj)/s3(jj)*(log(cos(c1-c2*t)/cos(c1))); % Braking distance, m
a = -(s2(jj) + s3(jj)*v^2)/s1(jj); % Deceleration, m/s^2
if jj==1, t2b(ii)=t; dis2b(ii)=dis; a2b(ii)=a; v2b(ii)=v; end
if jj==2, tfb(ii)=t; disfb(ii)=dis; afb(ii)=a; vfb(ii)=v; end
if jj==3, trb(ii)=t; disrb(ii)=dis; arb(ii)=a; vrb(ii)=v; end
end
end
rt = 3600/1000; % Convert v from m/s to km/hr

% Plotting braking distance vs. time
plot(t2b,dis2b, tfb,disfb, trb,disrb), grid
xlabel('Time, sec'), ylabel('Braking Distance, m')
ylim([0 60]), legend('Full brake', 'Front brake', 'Rear brake')
title(['m=',num2str(m), ' kg, \mu=', num2str(mu),...
', v_o=',num2str(kmhr),' km/hr'])
