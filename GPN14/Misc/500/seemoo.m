function spectrum

%read image
A = imread('img_sw.bmp');
A = imresize(A, [357 (2048/2)+1]);
signal=[];
for y=1:size(A,1)
    signal=generate_row(signal,A(y,1:end));
    disp(y);
end

out=ones(size(signal,2), size(signal,1)*2);
out(1:2:end)=real(signal);%real (I)
out(2:2:end)=imag(signal);%i (Q)

out=(out+1).*127;

out=uint8(out);

fid	= fopen('signal.bin','w');	
fwrite(fid, out, 'uint8'); 
fclose(fid);

end

function s = generate_row(s, indices)

n=round(size(indices,2)/2)*2;
row = ifft([fliplr(indices(1:(n/2))) fliplr(indices(((n/2)-1):n-1))], n, 'nonsymmetric');


s=[s ; row'];
end